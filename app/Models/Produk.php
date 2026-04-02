<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukFactory> */
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'gambar',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Get the detail penjualan for the produk.
     */
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    /**
     * Check if produk has enough stock
     */
    public function hasStock(int $quantity): bool
    {
        return $this->stok >= $quantity;
    }

    /**
     * Reduce stock
     */
    public function reduceStock(int $quantity): bool
    {
        if ($this->hasStock($quantity)) {
            $this->stok -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Add stock
     */
    public function addStock(int $quantity): void
    {
        $this->stok += $quantity;
        $this->save();
    }
    
}
