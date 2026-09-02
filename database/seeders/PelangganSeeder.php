<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggan')->insert([
            [
                'id' => 1,
                'nama_pelanggan' => 'Budi Santoso',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 45, Jakarta Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_pelanggan' => 'Siti Rahma',
                'no_hp' => '085712345678',
                'alamat' => 'Jl. Mawar No. 12, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_pelanggan' => 'Ahmad Fauzi',
                'no_hp' => '089698765432',
                'alamat' => 'Jl. Anggrek No. 8, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
