<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    /** @use HasFactory<\Database\Factories\PenjualanFactory> */
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'tanggal_penjualan',
        'total_harga',
        'pelanggan_id',
        'user_id',
    ];

    protected $casts = [
        'tanggal_penjualan' => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    /**
     * Get the pelanggan that owns the penjualan.
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /**
     * Get the user that owns the penjualan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the detail penjualan for the penjualan.
     */
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    /**
     * Calculate total from details
     */
    public function calculateTotal(): float
    {
        return $this->detailPenjualan->sum('subtotal');
    }
}
