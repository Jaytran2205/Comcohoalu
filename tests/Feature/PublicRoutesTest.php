<?php

namespace Tests\Feature;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicRoutesTest extends TestCase
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
     * Test that all main guest pages return 200 OK.
     */
    public function test_public_pages_render_successfully(): void
    {
        $pages = [
            '/',
            '/ve-chung-toi',
            '/menu',
            '/thuc-don-anh',
            '/dat-ban',
            '/lien-he',
            '/category/tin-tuc',
            '/category/khuyen-mai',
            '/category/tuyen-dung',
        ];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertStatus(200);
        }
    }

    /**
     * Test that a valid table booking submission is saved and redirects to confirmation.
     */
    public function test_booking_submission_creates_booking_and_redirects(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $payload = [
            'customer_name' => 'Nguyễn Văn Test',
            'customer_phone' => '0987654321',
            'customer_email' => 'test@gmail.com',
            'booking_date' => now()->addDays(2)->format('Y-m-d'),
            'booking_time' => '18:30',
            'adults' => 4,
            'children' => 2,
            'special_requests' => 'Cần bàn gần cửa sổ, ghế em bé',
        ];

        $response = $this->post('/dat-ban', $payload);

        // Assert booking is saved in DB
        $booking = Booking::where('customer_phone', '0987654321')->first();
        $this->assertNotNull($booking);
        $this->assertEquals('Nguyễn Văn Test', $booking->customer_name);
        $this->assertEquals(4, $booking->adults);

        // Assert emails were queued
        \Illuminate\Support\Facades\Mail::assertQueued(\App\Mail\BookingConfirmationMail::class);
        \Illuminate\Support\Facades\Mail::assertQueued(\App\Mail\AdminBookingNotificationMail::class);

        // Assert redirect to confirmation page
        $response->assertRedirect(route('booking.success', $booking->booking_code));
    }

    /**
     * Test booking validation fails when phone number format is invalid.
     */
    public function test_booking_validation_fails_with_invalid_phone(): void
    {
        $payload = [
            'customer_name' => 'Nguyễn Văn Test',
            'customer_phone' => '123456789', // Invalid prefix
            'booking_date' => now()->addDays(1)->format('Y-m-d'),
            'booking_time' => '12:00',
            'adults' => 2,
        ];

        $response = $this->post('/dat-ban', $payload);

        // Assert redirect back with errors on customer_phone
        $response->assertSessionHasErrors('customer_phone');
        $this->assertEquals(0, Booking::count());
    }

    /**
     * Test that a valid contact form submission is saved and queues notification email.
     */
    public function test_contact_submission_queues_email_and_redirects(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $payload = [
            'name' => 'Nguyễn Văn Liên Hệ',
            'phone' => '0987654321',
            'email' => 'contact-test@gmail.com',
            'subject' => 'Hỏi về tiệc cưới',
            'message' => 'Nội dung tin nhắn liên hệ thử nghiệm.',
        ];

        $response = $this->post('/lien-he', $payload);

        // Assert contact is saved in DB
        $contact = \App\Models\Contact::where('email', 'contact-test@gmail.com')->first();
        $this->assertNotNull($contact);

        // Assert email was queued to admin
        \Illuminate\Support\Facades\Mail::assertQueued(\App\Mail\AdminContactNotificationMail::class);

        // Assert redirect back with success message
        $response->assertRedirect();
        $response->assertSessionHas('success');
    }
}
