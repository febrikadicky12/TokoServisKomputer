<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailNotaPembayaran extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan nama konvensional
    protected $table = 'detail_nota_pembayaran';

    // Tentukan field yang bisa diisi
    protected $fillable = [
        'kode_nota', 
        'produk_kode',
        'jumlah',
        'harga',
    ];

    // Relasi ke model NotaPembayaran
    public function nota()
    {
        return $this->belongsTo(NotaPembayaran::class, 'kode_nota', 'kode_nota');
    }

    // Relasi ke model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_kode', 'kode_produk');
    }
}
