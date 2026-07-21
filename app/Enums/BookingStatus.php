<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Rejected = 'rejected';
    case Serving = 'serving';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case NoShow = 'no_show';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Chờ xác nhận',
            self::Confirmed => 'Đã xác nhận',
            self::Rejected => 'Từ chối',
            self::Serving => 'Đang phục vụ',
            self::Completed => 'Hoàn thành',
            self::Cancelled => 'Đã hủy',
            self::NoShow => 'Không đến',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Confirmed => 'info',
            self::Rejected => 'danger',
            self::Serving => 'primary',
            self::Completed => 'success',
            self::Cancelled => 'secondary',
            self::NoShow => 'danger',
        };
    }
}
