<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Cơm Cổ Hoa Lư',
            'email' => 'admin@comcohoalu.vn',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin,
        ]);

        User::create([
            'name' => 'Nhân viên',
            'email' => 'staff@comcohoalu.vn',
            'password' => Hash::make('password'),
            'role' => UserRole::Staff,
        ]);
    }
}
