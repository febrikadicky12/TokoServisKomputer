<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'nomor_pembayaran', 'nama_pelanggan', 'total_bayar',
        'metode_pembayaran', 'status', 'tanggal_pembayaran'
    ];

    // Relasi ke DetailPembayaran
    public function details()
    {
        return $this->hasMany(DetailPembayaran::class);
    }
}