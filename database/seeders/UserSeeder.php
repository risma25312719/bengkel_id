<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'nama_bengkel' => null,
                'email' => 'admin@gmail.com',
                'no_hp' => null,
                'alamat' => null,
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status_bengkel' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknisi Utama',
                'nama_bengkel' => 'Bengkel Teknisi Utama',
                'email' => 'teknisi@gmail.com',
                'no_hp' => null,
                'alamat' => null,
                'password' => Hash::make('password123'),
                'role' => 'teknisi',
                'status_bengkel' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'nama_bengkel' => null,
                'email' => 'budi@gmail.com',
                'no_hp' => null,
                'alamat' => null,
                'password' => Hash::make('password123'),
                'role' => 'pelanggan',
                'status_bengkel' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
