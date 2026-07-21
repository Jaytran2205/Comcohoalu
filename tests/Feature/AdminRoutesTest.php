<?php

namespace Tests\Feature;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Seed the database before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Guest access to admin is redirected to login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');

        $responseSettings = $this->get('/admin/settings');
        $responseSettings->assertRedirect('/login');
    }

    /**
     * Staff role user can access admin dashboard but cannot access settings.
     */
    public function test_staff_can_access_dashboard_but_not_settings(): void
    {
        // Find seeded staff user (seeded in UserSeeder)
        $staff = User::where('role', UserRole::Staff)->first();
        $this->assertNotNull($staff);

        // Access dashboard
        $responseDashboard = $this->actingAs($staff)->get('/admin');
        $responseDashboard->assertStatus(200);

        // Access settings (should fail with 403 Forbidden because of EnsureUserIsAdmin middleware)
        $responseSettings = $this->actingAs($staff)->get('/admin/settings');
        $responseSettings->assertStatus(403);
    }

    /**
     * Admin role user can access admin dashboard and settings page.
     */
    public function test_admin_can_access_all_admin_routes(): void
    {
        // Find seeded admin user (seeded in UserSeeder)
        $admin = User::where('role', UserRole::Admin)->first();
        $this->assertNotNull($admin);

        // Access dashboard
        $responseDashboard = $this->actingAs($admin)->get('/admin');
        $responseDashboard->assertStatus(200);

        // Access settings
        $responseSettings = $this->actingAs($admin)->get('/admin/settings');
        $responseSettings->assertStatus(200);

        // Access menu categories
        $responseCategories = $this->actingAs($admin)->get('/admin/menu-categories');
        $responseCategories->assertStatus(200);

        // Access menu boards
        $responseBoards = $this->actingAs($admin)->get('/admin/menu-boards');
        $responseBoards->assertStatus(200);
    }

    /**
     * Test admin login and logout flow.
     */
    public function test_admin_login_and_logout_flow(): void
    {
        // Access login page
        $responseForm = $this->get('/login');
        $responseForm->assertStatus(200);

        // Submit valid login credentials
        $responseLogin = $this->post('/login', [
            'email' => 'admin@comcohoalu.vn',
            'password' => 'password',
        ]);
        
        $responseLogin->assertRedirect('/admin');
        $this->assertAuthenticated();

        // Submit logout request
        $responseLogout = $this->post('/logout');
        $responseLogout->assertRedirect('/login');
        $this->assertGuest();
    }

    /**
     * Test that admin can successfully update restaurant settings.
     */
    public function test_admin_can_update_settings(): void
    {
        $admin = User::where('role', UserRole::Admin)->first();
        $this->assertNotNull($admin);

        $payload = [
            'site_name' => 'Cơm Cổ Hoa Lư Mới',
            'site_address' => '123 Đường Tràng An, Ninh Bình',
            'site_hotline' => '0999999999',
            'site_email' => 'new@comcohoalu.vn',
            'site_facebook' => 'https://facebook.com/newcomcohoalu',
            'site_tiktok' => 'https://tiktok.com/@newcomcohoalu',
            'site_zalo' => 'https://zalo.me/0999999999',
            'google_maps_embed' => '<iframe>new</iframe>',
            'google_analytics_code' => '<script>console.log("analytics");</script>',
            'booking_min_advance_minutes' => 45,
            'booking_max_per_phone' => 5,
            'lunch_open' => '09:30',
            'lunch_close' => '14:30',
            'dinner_open' => '16:30',
            'dinner_close' => '22:30',
        ];

        $response = $this->actingAs($admin)->put('/admin/settings', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Đã cập nhật cấu hình thành công.');

        // Verify values are updated in DB and cached values match
        $this->assertEquals('Cơm Cổ Hoa Lư Mới', \App\Models\Setting::get('site_name'));
        $this->assertEquals('123 Đường Tràng An, Ninh Bình', \App\Models\Setting::get('site_address'));
        $this->assertEquals('https://zalo.me/0999999999', \App\Models\Setting::get('site_zalo'));
        $this->assertEquals('<script>console.log("analytics");</script>', \App\Models\Setting::get('google_analytics_code'));
        
        $groupSettings = \App\Models\Setting::getGroup('general');
        $this->assertEquals('Cơm Cổ Hoa Lư Mới', $groupSettings['site_name']);
        $this->assertEquals('https://zalo.me/0999999999', $groupSettings['site_zalo']);
        $this->assertEquals('<script>console.log("analytics");</script>', $groupSettings['google_analytics_code']);

        // Refresh shared view variable for the test request
        \Illuminate\Support\Facades\View::share('siteSettings', \App\Models\Setting::allCached());

        // Verify the code is rendered on the public home page
        $responseHome = $this->get('/');
        $responseHome->assertSee('<script>console.log("analytics");</script>', false);
    }

    /**
     * Test admin can filter menu items by search, category, status, and featured state.
     */
    public function test_admin_can_filter_menu_items(): void
    {
        $admin = User::where('role', UserRole::Admin)->first();
        $this->assertNotNull($admin);

        // Find a category
        $category = \App\Models\MenuCategory::first();
        $this->assertNotNull($category);

        // Create a test item with unique values
        $uniqueName = 'Món Ăn Thử Nghiệm Bộ Lọc Độc Nhất';
        $item = \App\Models\MenuItem::create([
            'category_id' => $category->id,
            'name' => $uniqueName,
            'slug' => 'mon-an-thu-nghiem-bo-loc',
            'price' => 150000,
            'status' => \App\Enums\MenuItemStatus::Available,
            'is_featured' => true,
            'badge' => \App\Enums\MenuItemBadge::New,
        ]);

        // 1. Filter by keyword search (should find the item)
        $response = $this->actingAs($admin)->get('/admin/menu-items?search=' . urlencode($uniqueName));
        $response->assertStatus(200);
        $response->assertSee($uniqueName);

        // 2. Filter by keyword search with non-matching dummy text (should NOT find the item)
        $responseNoMatch = $this->actingAs($admin)->get('/admin/menu-items?search=dummy_no_match_text');
        $responseNoMatch->assertStatus(200);
        $responseNoMatch->assertDontSee($uniqueName);

        // 3. Filter by correct category
        $responseCat = $this->actingAs($admin)->get('/admin/menu-items?category_id=' . $category->id);
        $responseCat->assertStatus(200);
        $responseCat->assertSee($uniqueName);

        // 4. Filter by wrong category
        $responseWrongCat = $this->actingAs($admin)->get('/admin/menu-items?category_id=99999');
        $responseWrongCat->assertStatus(200);
        $responseWrongCat->assertDontSee($uniqueName);

        // 5. Filter by correct status
        $responseStatus = $this->actingAs($admin)->get('/admin/menu-items?status=available');
        $responseStatus->assertStatus(200);
        $responseStatus->assertSee($uniqueName);

        // 6. Filter by wrong status
        $responseWrongStatus = $this->actingAs($admin)->get('/admin/menu-items?status=hidden');
        $responseWrongStatus->assertStatus(200);
        $responseWrongStatus->assertDontSee($uniqueName);

        // 7. Filter by correct featured state
        $responseFeatured = $this->actingAs($admin)->get('/admin/menu-items?is_featured=1');
        $responseFeatured->assertStatus(200);
        $responseFeatured->assertSee($uniqueName);

        // 8. Filter by wrong featured state
        $responseWrongFeatured = $this->actingAs($admin)->get('/admin/menu-items?is_featured=0');
        $responseWrongFeatured->assertStatus(200);
        $responseWrongFeatured->assertDontSee($uniqueName);
    }
}
