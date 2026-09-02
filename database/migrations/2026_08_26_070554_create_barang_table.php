<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique(); // Contoh: BRG-001
            $table->string('nama_barang'); // Contoh: IC Power, LCD OLED, Resistor 10k
            $table->string('kategori')->nullable(); // Contoh: Komponen, Layar, Aksesori
            $table->decimal('harga_beli', 12, 2)->default(0); // Harga modal bengkel
            $table->decimal('harga_jual', 12, 2); // Harga jual ke konsumen
            $table->integer('stok')->default(0); // Sisa stok barang
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
        Schema::dropIfExists('barang');
    }
}