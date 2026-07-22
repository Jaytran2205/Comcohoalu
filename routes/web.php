<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Public Routes – Cơm Cổ Hoa Lư
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ve-chung-toi', [AboutController::class, 'index'])->name('about');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/thuc-don-anh', [MenuController::class, 'menuBoard'])->name('menu.board');

// Đặt bàn
Route::get('/dat-ban', [BookingController::class, 'create'])->name('booking.create');
Route::post('/dat-ban', [BookingController::class, 'store'])->name('booking.store');
Route::get('/dat-ban/{code}/xac-nhan', [BookingController::class, 'success'])->name('booking.success');

// Liên hệ
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.store');

// Bài viết (Tin tức, Khuyến mãi, Tuyển dụng)
Route::get('/category/{slug}', [PostController::class, 'category'])->name('posts.category');

/*
|--------------------------------------------------------------------------
| AJAX Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->group(function () {
    Route::get('/menu/filter', [MenuController::class, 'filter'])->name('api.menu.filter');
    Route::get('/menu/search', [MenuController::class, 'search'])->name('api.menu.search');
    Route::get('/menu/{id}', [MenuController::class, 'quickView'])->name('api.menu.quickview');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Quản lý đặt bàn
    Route::resource('bookings', Admin\BookingController::class)->except(['create', 'store']);

    // Quản lý thực đơn
    Route::resource('menu-items', Admin\MenuItemController::class);
    Route::resource('set-menus', Admin\SetMenuController::class);
    Route::resource('menu-categories', Admin\MenuCategoryController::class);
    Route::resource('menu-boards', Admin\MenuBoardController::class);

    // Quản lý bài viết
    Route::resource('posts', Admin\PostController::class);

    // Cấu hình nhà hàng (admin only)
    Route::middleware(\App\Http\Middleware\EnsureUserIsAdmin::class)->group(function () {
        Route::get('/settings', [Admin\SettingController::class, 'edit'])->name('settings');
        Route::put('/settings', [Admin\SettingController::class, 'update'])->name('settings.update');
    });
});

/*
|--------------------------------------------------------------------------
| Catch-all: Bài viết chi tiết (đặt cuối cùng)
|--------------------------------------------------------------------------
*/

Route::post('/run-migrations', function (\Illuminate\Http\Request $request) {
    // 1. Lấy token từ header X-Migration-Token
    $token = $request->header('X-Migration-Token');
    $secretToken = config('services.migration.secret_token');

    // Nếu cấu hình chưa thiết lập token bí mật
    if (empty($secretToken)) {
        Log::error('Migration failed: services.migration.secret_token is not set in configuration.');
        return response('Internal Server Error. Configuration missing.', 500);
    }

    // 2. So sánh token an toàn bằng hash_equals để chống timing attacks
    if ($token === null || !hash_equals($secretToken, $token)) {
        return response('Unauthorized.', 401);
    }

    // 3. Kiểm tra xem bảng cache_locks có tồn tại hay không trước khi thực thi
    $useLock = false;
    try {
        $useLock = Schema::hasTable('cache_locks');
    } catch (\Throwable $e) {
        Log::warning('Database schema check failed for table cache_locks: ' . $e->getMessage() . '. Running without lock checks.');
    }

    // 4. Khóa chống chạy trùng lặp bằng Cache Lock (nếu bảng cache_locks tồn tại)
    $lock = null;
    $lockAcquired = false;

    if ($useLock) {
        try {
            $lock = Cache::lock('migration_run_lock', 60);
            $lockAcquired = $lock->get();

            if (!$lockAcquired) {
                return response('Another migration run is already in progress.', 429);
            }
        } catch (\Throwable $e) {
            // Chế độ fail-safe: Nếu gặp lỗi khi chạy Lock (ví dụ lỗi dịch vụ cache), chặn không cho migrate
            Log::error('Cache lock service unavailable: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return response('Cache lock service unavailable.', 503);
        }
    }

    try {
        $fresh = $request->input('fresh') === '1';

        if ($fresh) {
            // Chạy migrate:fresh --seed khi tham số fresh được truyền rõ ràng là 1
            Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
            $action = 'migrate:fresh --seed';
        } else {
            // Mặc định chạy migrate thông thường
            Artisan::call('migrate', ['--force' => true]);
            $action = 'migrate';
        }

        return response()->json([
            'status' => 'success',
            'action' => $action,
            'message' => 'Migration completed successfully.'
        ]);
    } catch (\Throwable $e) {
        // Ghi log lỗi chi tiết trên máy chủ
        Log::error('Migration failed with exception: ' . $e->getMessage(), [
            'exception' => $e
        ]);

        return response('Migration failed, check server logs.', 500);
    } finally {
        // Luôn giải phóng lock nếu đã được lấy thành công để không bị treo
        if ($useLock && $lock && $lockAcquired) {
            try {
                $lock->release();
            } catch (\Throwable $e) {
                Log::error('Failed to release cache lock: ' . $e->getMessage());
            }
        }
    }
});

Route::get('/test-connection', function () {
    $host = env('DB_HOST');
    $port = env('DB_PORT');
    $db   = env('DB_DATABASE');
    $user = env('DB_USERNAME');
    $pass = env('DB_PASSWORD');

    $results = [];
    $results['env'] = [
        'host' => $host,
        'port' => $port,
        'db' => $db,
        'user' => $user,
        'pass_length' => strlen($pass),
    ];

    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$db";
        $results['dsn'] = $dsn;
        
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        
        $pdo = new PDO($dsn, $user, $pass, $options);
        $results['status'] = 'Success! Connected to database.';
        
        $stmt = $pdo->query('SELECT version()');
        $results['version'] = $stmt->fetchColumn();
    } catch (\Throwable $e) {
        $results['status'] = 'Failed';
        $results['error'] = [
            'class' => get_class($e),
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ];
    }
    
    return response()->json($results);
});

Route::get('/{slug}', [PostController::class, 'show'])->name('posts.show');
