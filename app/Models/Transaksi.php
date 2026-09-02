<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'pelanggan_id',
        'user_id',
        'layanan_id',
        'barang_id',
        'nama_perangkat',
        'keluhan_kerusakan',
        'jumlah_barang',
        'total_biaya',
        'status_servis',
        'status_bayar',
        'tgl_selesai',
    ];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // Relasi ke User (Teknisi/Kasir)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    // Relasi ke Barang (Sparepart)
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}