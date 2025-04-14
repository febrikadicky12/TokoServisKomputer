<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'produk_kode',
        'jumlah',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_kode', 'kode_produk');
    }
}
