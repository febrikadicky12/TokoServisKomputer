<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'kode_produk',
        'kategori',
        'merek',
        'jenis',
        'spesifikasi',
        'warna',
        'harga',
        'stok',
        'kondisi',
        'status',
        'gambar'
    ];
    // Produk.php
public function kode()
{
    return $this->belongsTo(Kode::class); // jika produk memiliki kode
}

}
