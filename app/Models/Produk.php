<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga',
    ];

    /**
     * Many-to-many relationship with NotaPembayaran via pivot table 'nota_produk'
     */
    public function notaPembayaran()
    {
        return $this->belongsToMany(NotaPembayaran::class, 'nota_produk', 'produk_id', 'nota_pembayaran_id')
                    ->withPivot('kuantitas', 'total_harga');
    }
}
