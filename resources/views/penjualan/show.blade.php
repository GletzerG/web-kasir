@extends('layouts.app')

@section('title', 'Detail Penjualan')
@section('page-title', 'Detail Penjualan')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                Detail Transaksi #{{ $penjualan->id }}
            </h1>

            <a href="{{ route('penjualan.index') }}"
                class="px-4 py-2 rounded-xl border text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                Kembali
            </a>
        </div>

        <!-- Info -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow border dark:border-gray-700 space-y-2">
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d M Y') }}</p>
            <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
            <p><strong>Total:</strong> <span class="text-green-600 font-bold">
                    Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                </span></p>
        </div>

        <!-- Detail Produk -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border dark:border-gray-700 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-4 py-3 text-left">Produk</th>
                        <th class="px-4 py-3 text-left">Harga</th>
                        <th class="px-4 py-3 text-left">Jumlah</th>
                        <th class="px-4 py-3 text-left">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($penjualan->detailPenjualan as $d)
                        <tr class="border-t dark:border-gray-700">
                            <td class="px-4 py-3">{{ $d->produk->nama_produk }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($d->produk->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $d->jumlah_produk }}</td>
                            <td class="px-4 py-3 font-semibold text-green-600">
                                Rp {{ number_format($d->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection