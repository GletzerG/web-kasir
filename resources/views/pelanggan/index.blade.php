@extends('layouts.app')

@section('title', 'Pelanggan')
@section('page-title', 'Pelanggan')

@section('content')
    <div class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Data Pelanggan
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">
                    Manajemen data pelanggan
                </p>
            </div>

            <a href="{{ route('pelanggan.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 
                bg-gradient-to-r from-cyan-500 to-cyan-600 
                hover:from-cyan-600 hover:to-cyan-700 
                text-white font-medium rounded-xl 
                shadow-lg shadow-cyan-500/30 
                transition-all duration-300 transform hover:-translate-y-0.5">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4"></path>
                </svg>

                Tambah Pelanggan
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 overflow-hidden">

            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/60 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-5 py-3.5 text-left text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest w-12">No</th>
                        <th class="px-5 py-3.5 text-left text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">Nama</th>
                        <th class="px-5 py-3.5 text-left text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">Alamat</th>
                        <th class="px-5 py-3.5 text-left text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">No HP</th>
                        <th class="px-5 py-3.5 text-right text-xs text-gray-400 dark:text-gray-500 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                    @forelse ($pelanggan as $index => $p)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">

                            <!-- No -->
                            <td class="px-5 py-4 font-mono text-xs text-gray-400 dark:text-gray-500">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>

                            <!-- Nama -->
                            <td class="px-5 py-4 font-medium text-gray-900 dark:text-gray-100">
                                {{ $p->nama_pelanggan }}
                            </td>

                            <!-- Alamat -->
                            <td class="px-5 py-4 text-gray-500 dark:text-gray-300">
                                {{ $p->alamat }}
                            </td>

                            <!-- No HP -->
                            <td class="px-5 py-4 font-mono text-gray-600 dark:text-gray-300">
                                {{ $p->nomor_telepon }}
                            </td>

                            <!-- Aksi -->
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">

                                    <!-- Edit -->
                                    <a href="{{ route('pelanggan.edit', $p->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg 
                                        border border-cyan-200 dark:border-cyan-800 
                                        bg-cyan-50 dark:bg-cyan-900/30 
                                        text-cyan-700 dark:text-cyan-400 
                                        hover:bg-cyan-100 dark:hover:bg-cyan-900/50 transition">

                                        Edit
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus {{ $p->nama_pelanggan }}?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg 
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
                                    Belum ada pelanggan
                                </p>

                                <a href="{{ route('pelanggan.create') }}"
                                    class="mt-2 inline-block text-sm text-cyan-600 dark:text-cyan-400 hover:text-cyan-700 dark:hover:text-cyan-300">
                                    + Tambah sekarang
                                </a>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-400 dark:text-gray-600 font-mono">
            {{ now()->format('d M Y, H:i') }} · {{ count($pelanggan) }} pelanggan
        </p>

    </div>
@endsection