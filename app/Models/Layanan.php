<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'biaya_jasa',
    ];

    // Satu layanan bisa dipakai di banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}