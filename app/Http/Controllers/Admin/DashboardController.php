<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\MenuItem;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'bookings_today' => Booking::today()->count(),
            'bookings_pending' => Booking::pending()->count(),
            'bookings_this_week' => Booking::whereBetween('booking_date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ])->count(),
            'total_menu_items' => MenuItem::available()->count(),
            'unread_contacts' => Contact::unread()->count(),
        ];

        $recentBookings = Booking::latest()
            ->take(10)
            ->get();

        $upcomingBookings = Booking::upcoming()
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('booking_date')
            ->orderBy('booking_time')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'upcomingBookings'));
    }
}
