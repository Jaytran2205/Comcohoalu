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
        $setMenus = \App\Models\SetMenu::active()->ordered()->with('items')->get();
        $categories = \App\Models\MenuCategory::active()->ordered()->with(['items' => function($q) {
            $q->available()->ordered();
        }])->get();

        return view('pages.booking', compact('settings', 'setMenus', 'categories'));
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

        $data = $request->validated();
        $orderType = $request->input('order_type', 'table_only');
        $setMenuId = $request->input('set_menu_id');
        $comboQuantity = max(1, (int)$request->input('combo_quantity', 1));
        $estimatedTotal = 0;
        $orderedItems = null;

        if ($orderType === 'combo' && $setMenuId) {
            $setMenu = \App\Models\SetMenu::with('items')->find($setMenuId);
            if ($setMenu) {
                $estimatedTotal = $setMenu->price * $comboQuantity;
            }
        } elseif ($orderType === 'custom_dishes') {
            $dishesInput = $request->input('dishes', []);
            $itemsList = [];
            if (is_array($dishesInput)) {
                foreach ($dishesInput as $dishId => $qty) {
                    $qty = (int) $qty;
                    if ($qty > 0) {
                        $dish = \App\Models\MenuItem::find($dishId);
                        if ($dish) {
                            $subtotal = $dish->price * $qty;
                            $estimatedTotal += $subtotal;
                            $itemsList[] = [
                                'id' => $dish->id,
                                'name' => $dish->name,
                                'price' => $dish->price,
                                'quantity' => $qty,
                                'subtotal' => $subtotal,
                            ];
                        }
                    }
                }
            }
            if (!empty($itemsList)) {
                $orderedItems = $itemsList;
            } else {
                $orderType = 'table_only';
            }
        }

        $booking = Booking::create([
            ...$data,
            'set_menu_id' => ($orderType === 'combo') ? $setMenuId : null,
            'combo_quantity' => ($orderType === 'combo') ? $comboQuantity : 1,
            'ordered_items' => $orderedItems,
            'estimated_total' => $estimatedTotal,
            'order_type' => $orderType,
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
