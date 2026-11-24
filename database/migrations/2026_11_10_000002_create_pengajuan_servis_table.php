<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanServisTable extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_servis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('bengkel_id')->constrained('users')->onDelete('cascade');
            $table->string('jenis_perangkat');
            $table->string('nama_perangkat');
            $table->text('keluhan_kerusakan');
            $table->string('lokasi_jemput_latitude')->nullable();
            $table->string('lokasi_jemput_longitude')->nullable();
            $table->string('status', 20)->default('menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_servis');
    }
}