<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique(); // Contoh: TRX-202609-001
            
            // Foreign Keys (Relasi ke tabel lain)
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Teknisi/Kasir
            $table->foreignId('layanan_id')->nullable()->constrained('layanan')->onDelete('set null');
            $table->foreignId('barang_id')->nullable()->constrained('barang')->onDelete('set null'); // Sparepart yang dipakai
            
            // Detail Servis
            $table->string('nama_perangkat'); // Contoh: TV LED Samsung 32 inch, Laptop Asus
            $table->text('keluhan_kerusakan'); // Contoh: Mati total, suara hilang
            $table->integer('jumlah_barang')->default(1); // Jumlah suku cadang yang digunakan
            
            // Informasi Biaya & Status
            $table->decimal('total_biaya', 12, 2)->default(0);
            $table->enum('status_servis', ['proses', 'menunggu_sparepart', 'selesai', 'batal'])->default('proses');
            $table->enum('status_bayar', ['belum_bayar', 'lunas'])->default('belum_bayar');
            $table->date('tgl_selesai')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}