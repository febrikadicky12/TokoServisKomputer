<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaProdukTable extends Migration
{
    public function up()
    {
        Schema::create('nota_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nota_pembayaran_id')->constrained('nota_pembayaran')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->integer('kuantitas');
            $table->decimal('total_harga', 15, 2);  // Adjust as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nota_produk');
    }
}
