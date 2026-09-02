<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $pelanggan = Pelanggan::first();
        $layanan   = Layanan::first();
        $barang    = Barang::first();

        if (!$pelanggan) {
            return;
        }

        // firstOrCreate akan membuat data BARU hanya jika kode_transaksi belum ada
        Transaksi::firstOrCreate(
            ['kode_transaksi' => 'TRX-' . date('Ymd') . '-001'],
            [
                'pelanggan_id'     => $pelanggan->id,
                'layanan_id'       => $layanan ? $layanan->id : null,
                'barang_id'        => $barang ? $barang->id : null,
                'nama_perangkat'   => 'iPhone X Black',
                'keluhan_kerusakan'=> 'HP mati total, tidak bisa di-charge',
                'jumlah_barang'    => 1,
                'total_biaya'      => 150000,
                'status_servis'    => 'proses',
                'status_bayar'     => 'belum_bayar',
            ]
        );
    }
}