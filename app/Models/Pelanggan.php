<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'kode_pelanggan';
    public $incrementing = false; // Assuming kode_pelanggan is a string or non-auto-increment field
    protected $keyType = 'string'; // Adjust this based on your key type

    protected $fillable = [
        'kode_pelanggan',
        'nama_pelanggan',
        'telepon',
        'email',
    ];

    /**
     * One-to-many relationship with NotaPembayaran
     */
    public function notaPembayarans()
    {
        return $this->hasMany(NotaPembayaran::class, 'kode_pelanggan', 'kode_pelanggan');
    }
}
