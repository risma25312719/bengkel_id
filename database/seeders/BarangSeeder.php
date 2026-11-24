<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert([
            [
                'id' => 1,
                'kode_barang' => 'BRG-001',
                'nama_barang' => 'IC Power iPhone X',
                'kategori' => 'IC',
                'harga_beli' => 80000,
                'harga_jual' => 150000,
                'stok' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'kode_barang' => 'BRG-002',
                'nama_barang' => 'LCD Original Asus ROG GL553',
                'kategori' => 'Layar',
                'harga_beli' => 750000,
                'harga_jual' => 950000,
                'stok' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'kode_barang' => 'BRG-003',
                'nama_barang' => 'Baterai Samsung Galaxy S20',
                'kategori' => 'Battery',
                'harga_beli' => 120000,
                'harga_jual' => 200000,
                'stok' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
