<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke tabel Pelanggan (jika user ini bertipe role 'pengguna')
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class);
    }

    // Relasi ke Transaksi yang ditangani oleh User ini (Admin/Teknisi)
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}