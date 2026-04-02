<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    /** @use HasFactory<\Database\Factories\PelangganFactory> */
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'nomor_telepon',
    ];

    /**
     * Get the penjualan for the pelanggan.
     */
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
