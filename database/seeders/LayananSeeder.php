<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('layanan')->insert([
            [
                'id' => 1,
                'nama_layanan' => 'Ganti LCD',
                'biaya_jasa' => 150000,
                'deskripsi' => 'Jasa penggantian layar LCD smartphone/laptop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_layanan' => 'Servis IC Power',
                'biaya_jasa' => 250000,
                'deskripsi' => 'Perbaikan komponen IC Power mati total',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_layanan' => 'Pembersihan & Thermal Paste',
                'biaya_jasa' => 100000,
                'deskripsi' => 'Cleaning fan dan penggantian pasta pendingin processor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
