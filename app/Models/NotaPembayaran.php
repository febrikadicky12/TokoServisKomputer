<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotaPembayaran extends Model
{
    protected $table = 'nota_pembayaran';
    protected $primaryKey = 'kode_notapembayaran';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kode_notapembayaran',
        'kode_pelanggan',
        'total_pembayaran',
        'tanggal',
    ];

    /**
     * Relasi ke pelanggan
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'kode_pelanggan', 'kode_pelanggan');
    }

    /**
     * Relasi ke keranjang berdasarkan kode pelanggan
     */
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'kode_pelanggan', 'kode_pelanggan');
    }

    /**
     * Relasi tidak langsung ke produk melalui keranjang
     */
    public function produkDariKeranjang()
    {
        return $this->hasManyThrough(Produk::class, Keranjang::class, 'kode_pelanggan', 'kode_produk', 'kode_pelanggan', 'produk_kode');
    }
}
