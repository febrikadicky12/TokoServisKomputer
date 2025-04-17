<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'produk_kode',
        'jumlah',
    ];

    /**
     * Relasi ke model Produk berdasarkan 'kode_produk'
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_kode', 'kode_produk');
    }

    /**
     * Hitung subtotal otomatis dari relasi produk
     */
    public function getSubtotalAttribute()
    {
        if ($this->produk) {
            return $this->jumlah * $this->produk->harga;
        }

        return 0;
    }

    /**
     * Cek apakah stok produk mencukupi untuk jumlah yang diminta
     */
    public function stokCukup()
    {
        if ($this->produk) {
            return $this->jumlah <= $this->produk->stok;
        }

        return false;
    }

    /**
     * Status keranjang berdasarkan stok
     * - 'tersedia' jika stok cukup
     * - 'pesan' jika stok kosong (tapi tetap boleh dipesan)
     * - 'tidak tersedia' jika produk tidak ditemukan
     */
    public function getStatusAttribute()
    {
        if (!$this->produk) {
            return 'tidak tersedia';
        }

        if ($this->produk->stok >= $this->jumlah) {
            return 'tersedia';
        }

        return 'pesan';
    }
}
