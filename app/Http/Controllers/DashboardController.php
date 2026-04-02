<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display dashboard
     */
    public function index()
    {
        $today = Carbon::today();
        
        // Today's sales
        $penjualanHariIni = Penjualan::whereDate('tanggal_penjualan', $today)->count();
        $totalPenjualanHariIni = Penjualan::whereDate('tanggal_penjualan', $today)->sum('total_harga');
        
        // Total counts
        $totalProduk = Produk::count();
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        
        // Recent sales
        $penjualanTerbaru = Penjualan::with(['pelanggan'])
            ->orderBy('tanggal_penjualan', 'desc')
            ->limit(5)
            ->get();
        
        // Low stock products
        $produkStokRendah = Produk::where('stok', '<=', 10)
            ->orderBy('stok', 'asc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'penjualanHariIni',
            'totalPenjualanHariIni',
            'totalProduk',
            'totalPelanggan',
            'totalPenjualan',
            'penjualanTerbaru',
            'produkStokRendah'
        ));
    }
}
