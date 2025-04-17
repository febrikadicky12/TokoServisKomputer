<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'kode_produk', 'kategori', 'merek', 'jenis', 'spesifikasi',
        'warna', 'harga', 'stok', 'kondisi', 'status', 'gambar', 'kode_supplier'
    ];

    /**
     * Relasi ke tabel supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'kode_supplier', 'kode_supplier');
    }

    /**
     * Update status produk berdasarkan stok secara otomatis
     */
    public function tambahStok($jumlah)
    {
        $this->stok += $jumlah;
        $this->updateStatus();
        $this->save();
    }
    
    public function kurangiStok($jumlah)
    {
        $this->stok -= $jumlah;
        $this->stok = max(0, $this->stok); 
        $this->updateStatus();
        $this->save();
    }
    
    public function updateStatus()
    {
        if ($this->stok > 0) {
            $this->status = 'Tersedia';
        } elseif ($this->status !== 'Pesan') {
            $this->status = 'Habis';
        }
    }
    
    
}
