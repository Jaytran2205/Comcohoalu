<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Setting;
use App\Mail\BookingConfirmationMail;
use App\Mail\AdminBookingNotificationMail;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Hiển thị form đặt bàn.
     * Không cần load branches – chỉ 1 cơ sở.
     */
    public function create()
    {
        $settings = Setting::getGroup('booking');

        return view('pages.booking', compact('settings'));
    }

    /**
     * Xử lý submit đặt bàn.
     */
    public function store(BookingRequest $request)
    {
        // Kiểm tra giới hạn đặt bàn theo SĐT
        $maxPerPhone = (int) Setting::get('booking_max_per_phone', 3);

        $activeBookings = Booking::where('customer_phone', $request->customer_phone)
            ->active()
            ->count();

        if ($activeBookings >= $maxPerPhone) {
            return back()
                ->withInput()
                ->withErrors([
                    'customer_phone' => "Bạn đã có {$maxPerPhone} đơn đặt bàn chưa hoàn thành. Vui lòng liên hệ hotline để được hỗ trợ.",
                ]);
        }

        $booking = Booking::create([
            ...$request->validated(),
            'status' => BookingStatus::Pending,
        ]);

        // Gửi email xác nhận cho khách hàng (nếu cung cấp email)
        if ($booking->customer_email) {
            Mail::to($booking->customer_email)->send(new BookingConfirmationMail($booking));
        }

        // Gửi email thông báo cho Admin
        $adminEmail = Setting::get('site_email', 'contact@comcohoalu.vn');
        Mail::to($adminEmail)->send(new AdminBookingNotificationMail($booking));

        return redirect()
            ->route('booking.success', $booking->booking_code)
            ->with('success', 'Đặt bàn thành công!');
    }

    /**
     * Trang xác nhận đặt bàn thành công.
     */
    public function success(string $code)
    {
        $booking = Booking::where('booking_code', $code)->firstOrFail();
        $settings = Setting::allCached();

        return view('pages.booking-success', compact('booking', 'settings'));
    }
}
