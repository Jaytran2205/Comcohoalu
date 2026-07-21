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

use Illuminate\Support\Facades\Artisan;

Route::get('/run-migrations', function () {
    try {
        Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        return 'Migrations and seeding completed successfully!<br><br>Output:<br><pre>' . Artisan::output() . '</pre>';
    } catch (\Throwable $e) {
        return 'Error: ' . $e->getMessage() . '<br><br>Trace:<br><pre>' . $e->getTraceAsString() . '</pre>';
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
