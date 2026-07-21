<?php

namespace App\Enums;

enum MenuItemBadge: string
{
    case None = 'none';
    case BestSeller = 'best_seller';
    case Specialty = 'specialty';
    case New = 'new';

    public function label(): string
    {
        return match ($this) {
            self::None => '',
            self::BestSeller => 'Bán chạy',
            self::Specialty => 'Đặc sản',
            self::New => 'Mới',
        };
    }
}
