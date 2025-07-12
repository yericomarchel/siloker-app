<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@disnakerbatam.go.id'],
            [
                'name' => 'Admin Disnaker Batam',
                'password' => Hash::make('password123'), // GANTI PASSWORD INI DI PRODUKSI!
                'role' => 'admin',
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );
        $this->command->info('Akun Admin berhasil di-seed.');
    }
}
