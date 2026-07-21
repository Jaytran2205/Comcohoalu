<?php

namespace App\Enums;

enum MenuItemStatus: string
{
    case Available = 'available';
    case SoldOut = 'sold_out';
    case Hidden = 'hidden';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Còn hàng',
            self::SoldOut => 'Hết hàng',
            self::Hidden => 'Ẩn',
        };
    }
}
