<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
        ['email' => 'superadmin@prodi.ac.id'],
        [
            'name' => 'Super Administrator',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]
        );
        $superAdmin->assignRole('Super Admin');

        $adminProdi = User::firstOrCreate(
        ['email' => 'admin@prodi.ac.id'],
        [
            'name' => 'Admin Prodi',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]
        );
        $adminProdi->assignRole('Admin Prodi');

        $editor = User::firstOrCreate(
        ['email' => 'editor@prodi.ac.id'],
        [
            'name' => 'Editor Konten',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]
        );
        $editor->assignRole('Editor Konten');
    }
}
