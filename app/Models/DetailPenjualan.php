<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    /** @use HasFactory<\Database\Factories\DetailPenjualanFactory> */
    use HasFactory;

    protected $table = 'detail_penjualan';

    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'jumlah_produk',
        'subtotal',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
    ];

    /**
     * Get the penjualan that owns the detail.
     */
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    /**
     * Get the produk that owns the detail.
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    /**
     * Calculate subtotal
     */
    public function calculateSubtotal(): float
    {
        return $this->produk->harga * $this->jumlah_produk;
    }
}
