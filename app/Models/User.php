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
        'nama_bengkel',
        'email',
        'no_hp',
        'alamat',
        'password',
        'role', // Wajib dimasukkan ke fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}