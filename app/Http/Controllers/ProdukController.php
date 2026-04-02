<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $produk = Produk::when($search, function ($query, $search) {
            return $query->where('nama_produk', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->get(); // <-- diganti dari paginate(10) ke get()

        return view('produk.index', compact('produk', 'search'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        if ($request->hasFile('gambar')) {
            $produk->gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $produk->gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->detailPenjualan()->count() > 0) {
            return redirect()->route('produk.index')
                ->with('error', 'Produk tidak dapat dihapus karena sudah memiliki transaksi!');
        }

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->route('produk.index')->with('error', 'Tidak ada produk yang dipilih.');
        }

        $produks = Produk::whereIn('id', $ids)->get();

        foreach ($produks as $produk) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $produk->delete();
        }

        return redirect()->route('produk.index')
            ->with('success', count($produks) . ' produk berhasil dihapus.');
    }
}