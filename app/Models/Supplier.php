<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $primaryKey = 'kode_supplier';
    public $incrementing = false; // karena pakai string bukan auto increment

    protected $fillable = [
        'kode_supplier', 'nama_supplier', 'alamat', 'telepon'
    ];

    /**
     * Relasi ke produk
     */
    public function produk()
    {
        return $this->hasMany(Produk::class, 'kode_supplier', 'kode_supplier');
    }
}
