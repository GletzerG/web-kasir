<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelangganRequest;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $pelanggan = Pelanggan::when($search, function ($query, $search) {
            return $query->where('nama_pelanggan', 'like', "%{$search}%")
                ->orWhere('nomor_telepon', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('pelanggan.index', compact('pelanggan', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PelangganRequest $request)
    {
        Pelanggan::create($request->validated());

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->validated());

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        // Check if pelanggan has sales
        if ($pelanggan->penjualan()->count() > 0) {
            return redirect()->route('pelanggan.index')
                ->with('error', 'Pelanggan tidak dapat dihapus karena sudah memiliki transaksi!');
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus!');
    }
}
