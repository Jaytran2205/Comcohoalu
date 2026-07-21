<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::query()
            ->when($request->filled('date'), fn ($q) => $q->whereDate('booking_date', $request->date))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate(20);

        $statuses = BookingStatus::cases();

        return view('admin.bookings.index', compact('bookings', 'statuses'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => ['required', 'string'],
            'admin_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $booking->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $booking->admin_notes,
            'confirmed_by' => $request->user()->id,
            'confirmed_at' => now(),
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', "Đơn {$booking->booking_code} đã được cập nhật.");
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', "Đã xóa đơn {$booking->booking_code}.");
    }
}
