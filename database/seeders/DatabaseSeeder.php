<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\UserRoleEnum;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'password' => Hash::make('password'),
            'role' => UserRoleEnum::SUPER_ADMIN,
            'referral_code' => null,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => UserRoleEnum::ADMIN,
            'referral_code' => 'ADMIN001',
        ]);

        User::create([
            'name' => 'Mitra Test',
            'email' => 'mitra@test.com',
            'password' => Hash::make('password'),
            'role' => UserRoleEnum::MITRA,
            'referral_code' => 'MITRA001',
        ]);

        User::create([
            'name' => 'Promotor Test',
            'email' => 'promotor@test.com',
            'password' => Hash::make('password'),
            'role' => UserRoleEnum::PROMOTOR,
            'referral_code' => 'PROMOTOR001',
        ]);
    }
}