<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'no_hp',
        'alamat',
    ];

    // Relasi balik ke User (Opsional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu pelanggan bisa punya banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}