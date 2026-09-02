<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksi')->insert([
            [
                'pelanggan_id' => 1,
                'nama_perangkat' => 'iPhone X Black',
                'keluhan_kerusakan' => 'HP mati total, tidak bisa di-charge',
                'layanan_id' => 2,
                'barang_id' => 1,
                'jumlah_barang' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 2,
                'nama_perangkat' => 'Laptop Asus ROG GL553',
                'keluhan_kerusakan' => 'Layar pecah/bergaris akibat terbentur',
                'layanan_id' => 1,
                'barang_id' => 2,
                'jumlah_barang' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pelanggan_id' => 3,
                'nama_perangkat' => 'MacBook Pro 2018',
                'keluhan_kerusakan' => 'Cepat panas dan kipas berbunyi bising',
                'layanan_id' => 3,
                'barang_id' => null,
                'jumlah_barang' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
