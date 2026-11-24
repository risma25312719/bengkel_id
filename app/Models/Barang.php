<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    // Satu barang/sparepart bisa digunakan di banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}