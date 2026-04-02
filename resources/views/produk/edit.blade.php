@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
    <div class="flex justify-center min-h-[80vh]">
        <div class="w-full max-w-xl">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data"
                class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama Produk -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="w-full border p-2 rounded
                                   bg-white dark:bg-gray-700
                                   border-gray-300 dark:border-gray-600
                                   text-gray-900 dark:text-gray-100
                                   placeholder-gray-400 dark:placeholder-gray-500
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('nama_produk')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="w-full border p-2 rounded
                                   bg-white dark:bg-gray-700
                                   border-gray-300 dark:border-gray-600
                                   text-gray-900 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('harga')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="w-full border p-2 rounded
                                   bg-white dark:bg-gray-700
                                   border-gray-300 dark:border-gray-600
                                   text-gray-900 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('stok')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar Lama -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Gambar Sekarang</label>
                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                            class="w-24 h-24 object-cover rounded mt-1 border border-gray-200 dark:border-gray-600">
                    @else
                        <span class="text-xs text-gray-400 dark:text-gray-500">Tidak ada gambar</span>
                    @endif
                </div>

                <!-- Upload Gambar Baru -->
                <div>
                    <label class="block text-sm mb-1 text-gray-700 dark:text-gray-300">Ganti Gambar</label>
                    <input type="file" name="gambar" class="w-full border p-2 rounded
                                   bg-white dark:bg-gray-700
                                   border-gray-300 dark:border-gray-600
                                   text-gray-900 dark:text-gray-100
                                   file:mr-3 file:py-1 file:px-3
                                   file:rounded file:border-0
                                   file:text-sm file:font-medium
                                   file:bg-cyan-50 file:text-cyan-700
                                   dark:file:bg-cyan-900/30 dark:file:text-cyan-400
                                   hover:file:bg-cyan-100 dark:hover:file:bg-cyan-900/50
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('gambar')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Update -->
                <button
                    class="w-full bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 text-white py-2 rounded transition-colors duration-150">
                    Update Produk
                </button>
            </form>
        </div>
    </div>
@endsection