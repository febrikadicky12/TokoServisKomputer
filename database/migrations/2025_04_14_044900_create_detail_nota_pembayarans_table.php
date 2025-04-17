<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailNotaPembayaranTable extends Migration
{
    public function up()
    {
        Schema::create('detail_nota_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nota'); // Referensi ke kode_nota di tabel nota_pembayaran
            $table->string('produk_kode'); // Kode produk
            $table->integer('jumlah'); // Jumlah produk yang dibeli
            $table->decimal('harga', 15, 2); // Harga produk
            $table->timestamps();

            // Foreign key constraint (relasi dengan tabel nota_pembayaran dan produk)
            $table->foreign('kode_nota')->references('kode_nota')->on('nota_pembayaran')->onDelete('cascade');
            $table->foreign('produk_kode')->references('kode_produk')->on('produk')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_nota_pembayaran');
    }
}
