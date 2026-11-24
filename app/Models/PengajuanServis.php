<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanServis extends Model
{
    use HasFactory;

    const JENIS_PERANGKAT = [
        'Televisi',
        'Laptop',
        'Komputer / PC',
        'Printer',
        'Smartphone',
        'Tablet',
        'Speaker / Audio',
        'Kulkas',
        'Mesin Cuci',
        'Perangkat Elektronik Lainnya',
    ];

    protected $table = 'pengajuan_servis';

    protected $fillable = [
        'pelanggan_id',
        'bengkel_id',
        'jenis_perangkat',
        'nama_perangkat',
        'keluhan_kerusakan',
        'lokasi_jemput_latitude',
        'lokasi_jemput_longitude',
        'status',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'pelanggan_id');
    }

    public function bengkel()
    {
        return $this->belongsTo(User::class, 'bengkel_id');
    }
}
