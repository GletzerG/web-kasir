@extends('layouts.app')

@section('title', 'Data Penjualan')
@section('page-title', 'Data Penjualan')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Data Penjualan
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">
                    Riwayat transaksi yang telah dilakukan
                </p>
            </div>

            <a href="{{ route('penjualan.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 
                bg-gradient-to-r from-cyan-500 to-cyan-600 
                hover:from-cyan-600 hover:to-cyan-700 
                text-white font-medium rounded-xl 
                shadow-lg shadow-cyan-500/30 
                transition-all duration-300 transform hover:-translate-y-0.5">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>

                Tambah Transaksi
            </a>
        </div>

        <!-- Table -->
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 overflow-hidden">

            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/60 border-b border-gray-200 dark:border-gray-700">
                        <th
                            class="px-5 py-3.5 text-left text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                            ID</th>
                        <th
                            class="px-5 py-3.5 text-left text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                            Tanggal</th>
                        <th
                            class="px-5 py-3.5 text-left text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                            Pelanggan</th>
                        <th
                            class="px-5 py-3.5 text-left text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                            Total</th>
                        <th
                            class="px-5 py-3.5 text-right text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                            Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                    @forelse($penjualan as $p)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">

                            <!-- ID -->
                            <td class="px-5 py-4 font-mono text-xs text-gray-400 dark:text-gray-500">
                                #{{ $p->id }}
                            </td>

                            <!-- Tanggal -->
                            <td class="px-5 py-4 text-gray-600 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($p->tanggal_penjualan)->format('d M Y') }}
                            </td>

                            <!-- Pelanggan -->
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 text-xs rounded-lg 
                                bg-gray-100 dark:bg-gray-700 
                                text-gray-600 dark:text-gray-300">
                                    {{ $p->pelanggan->nama_pelanggan ?? 'Umum' }}
                                </span>
                            </td>

                            <!-- Total -->
                            <td class="px-5 py-4 font-mono text-cyan-600 dark:text-cyan-400">
                                Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                            </td>

                            <!-- Aksi -->
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">

                                    <!-- Detail -->
                                    <a href="{{ route('penjualan.show', $p->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg 
                                        border border-cyan-200 dark:border-cyan-800 
                                        bg-cyan-50 dark:bg-cyan-900/30 
                                        text-cyan-700 dark:text-cyan-400 
                                        hover:bg-cyan-100 dark:hover:bg-cyan-900/50 transition">

                                        Detail
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('penjualan.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus transaksi ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg 
                                            border border-red-200 dark:border-red-800 
                                            bg-red-50 dark:bg-red-900/30 
                                            text-red-600 dark:text-red-400 
                                            hover:bg-red-100 dark:hover:bg-red-900/50 transition">

                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">
                                <p class="text-gray-500 dark:text-gray-400 font-medium">
                                    Belum ada transaksi 😶
                                </p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-400 dark:text-gray-600 font-mono">
            {{ now()->format('d M Y, H:i') }} · {{ count($penjualan) }} transaksi
        </p>

    </div>
@endsection