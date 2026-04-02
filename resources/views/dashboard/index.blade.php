@extends('layouts.app')
@extends('components.sidebar')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Selamat datang kembali, {{ auth()->user()->name }}!</p>
            </div>
            <a href="{{ route('penjualan.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white font-medium rounded-xl shadow-lg shadow-cyan-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Transaksi Baru
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Penjualan Hari Ini -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Penjualan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $penjualanHariIni }}</p>
                        <p class="text-sm text-cyan-600 dark:text-cyan-400 mt-1">transaksi</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center">
                        <svg class="w-7 h-7 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Penjualan Hari Ini -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Penjualan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">Rp
                            {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</p>
                        <p class="text-sm text-green-600 dark:text-green-400 mt-1">hari ini</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Produk -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $totalProduk }}</p>
                        <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">item</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Pelanggan -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pelanggan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ $totalPelanggan }}</p>
                        <p class="text-sm text-purple-600 dark:text-purple-400 mt-1">orang</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center">
                        <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Sales -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Penjualan Terbaru</h2>
                        <a href="{{ route('penjualan.index') }}"
                            class="text-sm text-cyan-600 dark:text-cyan-400 hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    @if($penjualanTerbaru->count() > 0)
                        <div class="space-y-4">
                            @foreach($penjualanTerbaru as $penjualan)
                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/60 rounded-xl">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $penjualan->pelanggan->nama_pelanggan }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $penjualan->tanggal_penjualan->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                    <p class="font-semibold text-cyan-600 dark:text-cyan-400">
                                        Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Belum ada penjualan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Low Stock Products -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Stok Menipis</h2>
                        <a href="{{ route('produk.index') }}"
                            class="text-sm text-cyan-600 dark:text-cyan-400 hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    @if($produkStokRendah->count() > 0)
                        <div class="space-y-4">
                            @foreach($produkStokRendah as $produk)
                                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/60 rounded-xl">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-lg {{ $produk->stok <= 5 ? 'bg-red-100 dark:bg-red-900/40' : 'bg-yellow-100 dark:bg-yellow-900/40' }} flex items-center justify-center">
                                            <svg class="w-5 h-5 {{ $produk->stok <= 5 ? 'text-red-600 dark:text-red-400' : 'text-yellow-600 dark:text-yellow-400' }}"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $produk->nama_produk }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Rp
                                                {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p
                                            class="font-semibold {{ $produk->stok <= 5 ? 'text-red-600 dark:text-red-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                                            {{ $produk->stok }} unit
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">tersisa</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-green-300 dark:text-green-700 mb-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Semua stok dalam kondisi baik</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="{{ route('produk.create') }}"
                    class="flex flex-col items-center gap-3 p-4 bg-gray-50 dark:bg-gray-700/60 rounded-xl hover:bg-cyan-50 dark:hover:bg-cyan-900/20 transition-colors group">
                    <div
                        class="w-12 h-12 rounded-xl bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center group-hover:bg-cyan-200 dark:group-hover:bg-cyan-800/60 transition-colors">
                        <svg class="w-6 h-6 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tambah Produk</span>
                </a>

                <a href="{{ route('pelanggan.create') }}"
                    class="flex flex-col items-center gap-3 p-4 bg-gray-50 dark:bg-gray-700/60 rounded-xl hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors group">
                    <div
                        class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center group-hover:bg-purple-200 dark:group-hover:bg-purple-800/60 transition-colors">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tambah Pelanggan</span>
                </a>

                <a href="{{ route('penjualan.create') }}"
                    class="flex flex-col items-center gap-3 p-4 bg-gray-50 dark:bg-gray-700/60 rounded-xl hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors group">
                    <div
                        class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center group-hover:bg-green-200 dark:group-hover:bg-green-800/60 transition-colors">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Transaksi Baru</span>
                </a>

                <a href="{{ route('produk.index') }}"
                    class="flex flex-col items-center gap-3 p-4 bg-gray-50 dark:bg-gray-700/60 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors group">
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center group-hover:bg-blue-200 dark:group-hover:bg-blue-800/60 transition-colors">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Laporan Stok</span>
                </a>
            </div>
        </div>
    </div>
@endsection