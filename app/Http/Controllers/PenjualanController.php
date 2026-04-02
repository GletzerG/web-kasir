<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenjualanRequest;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $penjualan = Penjualan::with(['pelanggan', 'user'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('pelanggan', function ($q) use ($search) {
                    $q->where('nama_pelanggan', 'like', "%{$search}%");
                });
            })
            ->when($dateFrom, function ($query, $dateFrom) {
                return $query->whereDate('tanggal_penjualan', '>=', $dateFrom);
            })
            ->when($dateTo, function ($query, $dateTo) {
                return $query->whereDate('tanggal_penjualan', '<=', $dateTo);
            })
            ->orderBy('tanggal_penjualan', 'desc')
            ->paginate(10);

        return view('penjualan.index', compact('penjualan', 'search', 'dateFrom', 'dateTo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::orderBy('nama_pelanggan')->get();
        $produk = Produk::where('stok', '>', 0)->orderBy('nama_produk')->get();

        return view('penjualan.create', compact('pelanggan', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenjualanRequest $request)
    {
        try {
            DB::beginTransaction();

            // Buat header penjualan
            $penjualan = Penjualan::create([
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'total_harga' => 0,
                'pelanggan_id' => $request->pelanggan_id,
                'user_id' => auth()->id(),
            ]);

            $totalHarga = 0;

            // Proses setiap produk dalam array
            foreach ($request->produk as $item) {
                $produk = Produk::findOrFail($item['produk_id']);
                $jumlah = (int) $item['jumlah'];

                // Cek stok
                if (!$produk->hasStock($jumlah)) {
                    DB::rollBack();
                    return back()->withErrors([
                        'produk' => "Stok {$produk->nama_produk} tidak mencukupi. Stok tersedia: {$produk->stok}"
                    ])->withInput();
                }

                $subtotal = $produk->harga * $jumlah;
                $totalHarga += $subtotal;

                // Buat detail penjualan
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $produk->id,
                    'jumlah_produk' => $jumlah,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi stok
                $produk->reduceStock($jumlah);
            }

            // Update total
            $penjualan->update(['total_harga' => $totalHarga]);

            DB::commit();

            return redirect()->route('penjualan.show', $penjualan)
                ->with('success', 'Penjualan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['pelanggan', 'user', 'detailPenjualan.produk']);
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        try {
            DB::beginTransaction();

            // Kembalikan stok
            foreach ($penjualan->detailPenjualan as $detail) {
                $detail->produk->addStock($detail->jumlah_produk);
            }

            // Hapus penjualan (detail terhapus via cascade)
            $penjualan->delete();

            DB::commit();

            return redirect()->route('penjualan.index')
                ->with('success', 'Penjualan berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get produk info for AJAX request
     */
    public function getProdukInfo(Produk $produk)
    {
        return response()->json([
            'id' => $produk->id,
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->harga,
            'stok' => $produk->stok,
        ]);
    }
}