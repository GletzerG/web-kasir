@extends('layouts.app')

@section('title', 'Tambah Penjualan')
@section('page-title', 'Tambah Penjualan')

@section('content')
    <div x-data="penjualanForm()" x-init="init()" class="space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Catat Transaksi</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Input transaksi penjualan baru</p>
            </div>
            <a href="{{ route('penjualan.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 hover:border-gray-300 dark:hover:border-gray-600 text-sm font-medium transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- Errors -->
        @if($errors->any())
            <div
                class="flex items-start gap-3 p-4 rounded-xl border border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/30">
                <svg class="w-5 h-5 text-red-500 dark:text-red-400 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <ul class="text-sm text-red-700 dark:text-red-400 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penjualan.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Info Transaksi -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 p-6">
                <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4">Informasi
                    Transaksi</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Pelanggan -->
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pelanggan
                            <span class="text-xs font-normal text-gray-400 dark:text-gray-500">(opsional)</span>
                        </label>
                        <select name="pelanggan_id" class="w-full px-4 py-2.5 rounded-xl border text-sm
                                    bg-white dark:bg-gray-700/50 border-gray-200 dark:border-gray-600
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:focus:ring-cyan-600 focus:border-transparent
                                    transition-colors duration-150">
                            {{-- <option value="">pilih pelanggan</option> --}}
                            @foreach($pelanggan as $p)
                                <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_pelanggan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Penjualan -->
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Penjualan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_penjualan" value="{{ old('tanggal_penjualan', date('Y-m-d')) }}"
                            required class="w-full px-4 py-2.5 rounded-xl border text-sm
                                    bg-white dark:bg-gray-700/50 border-gray-200 dark:border-gray-600
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:focus:ring-cyan-600 focus:border-transparent
                                    transition-colors duration-150
                                    {{ $errors->has('tanggal_penjualan') ? 'border-red-400 dark:border-red-600' : '' }}">
                        @error('tanggal_penjualan')
                            <p class="text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" class="w-full sm:w-48 px-4 py-2.5 rounded-xl border text-sm
                                    bg-white dark:bg-gray-700/50 border-gray-200 dark:border-gray-600
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:focus:ring-cyan-600 focus:border-transparent
                                    transition-colors duration-150">
                            <option value="lunas" {{ old('status', 'lunas') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Grid Produk -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 p-6">
                <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4">
                    Pilih Produk <span class="text-red-500">*</span>
                </h2>

                @error('produk')
                    <p class="text-xs text-red-500 dark:text-red-400 mb-3">{{ $message }}</p>
                @enderror

                {{-- Search & Filter --}}
                <div class="flex flex-col sm:flex-row gap-3 mb-5">

                    {{-- Search --}}
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                        </svg>
                        <input type="text" x-model="search" placeholder="Cari nama produk..." class="w-full pl-9 pr-4 py-2.5 text-sm rounded-xl border
                                       bg-white dark:bg-gray-700/50 border-gray-200 dark:border-gray-600
                                       text-gray-900 dark:text-gray-100 placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-cyan-500/30 focus:border-cyan-500
                                       transition-colors duration-150">
                    </div>

                    {{-- Filter Stok --}}
                    <div class="flex gap-2">
                        <button type="button" @click="filterStok = 'semua'"
                            :class="filterStok === 'semua'
                                    ? 'bg-cyan-500 text-white border-cyan-500'
                                    : 'bg-white dark:bg-gray-700/50 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-600 hover:border-cyan-400'"
                            class="px-3 py-2 text-xs font-medium rounded-xl border transition-all duration-150">
                            Semua
                        </button>
                        <button type="button" @click="filterStok = 'tersedia'"
                            :class="filterStok === 'tersedia'
                                    ? 'bg-cyan-500 text-white border-cyan-500'
                                    : 'bg-white dark:bg-gray-700/50 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-600 hover:border-cyan-400'"
                            class="px-3 py-2 text-xs font-medium rounded-xl border transition-all duration-150">
                            Tersedia
                        </button>
                        <button type="button" @click="filterStok = 'habis'"
                            :class="filterStok === 'habis'
                                    ? 'bg-red-500 text-white border-red-500'
                                    : 'bg-white dark:bg-gray-700/50 text-gray-600 dark:text-gray-400 border-gray-200 dark:border-gray-600 hover:border-red-400'"
                            class="px-3 py-2 text-xs font-medium rounded-xl border transition-all duration-150">
                            Habis
                        </button>
                    </div>
                </div>

                {{-- Hasil pencarian kosong --}}
                <p x-show="filteredProduk().length === 0" class="text-sm text-gray-400 dark:text-gray-500 text-center py-8">
                    Tidak ada produk yang cocok.
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($produk as $p)
                        <div x-show="isVisible({{ $p->id }}, '{{ strtolower($p->nama_produk) }}', {{ $p->stok }})" class="relative flex flex-col rounded-xl border transition-all duration-200 overflow-hidden
                                           border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/40
                                           hover:border-cyan-300 dark:hover:border-cyan-700 hover:shadow-md"
                            :class="isInCart({{ $p->id }}) ? 'border-cyan-400 dark:border-cyan-600 ring-2 ring-cyan-400/30 dark:ring-cyan-600/30' : ''">

                            <!-- Badge qty -->
                            <div x-show="isInCart({{ $p->id }})"
                                class="absolute top-2 right-2 z-10 w-6 h-6 rounded-full bg-cyan-500 text-white text-xs font-bold flex items-center justify-center shadow">
                                <span x-text="getQty({{ $p->id }})"></span>
                            </div>

                            <!-- Foto -->
                            <div class="w-full aspect-square bg-gray-100 dark:bg-gray-700 overflow-hidden">
                                <img src="{{ $p->gambar ? asset('storage/' . $p->gambar) : '' }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"
                                    class="w-full h-full object-cover">
                                <div class="w-full h-full items-center justify-center hidden">
                                    <svg class="w-10 h-10 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="p-3 flex flex-col gap-2 flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 leading-tight">
                                    {{ $p->nama_produk }}</p>
                                <p class="text-xs text-cyan-600 dark:text-cyan-400 font-semibold">Rp
                                    {{ number_format($p->harga, 0, ',', '.') }}</p>
                                <p class="text-xs"
                                    :class="{{ $p->stok }} > 0 ? 'text-gray-400 dark:text-gray-500' : 'text-red-400'">
                                    Stok: {{ $p->stok }}
                                </p>

                                @if($p->stok > 0)
                                    <button type="button"
                                        @click="addToCart({ id: {{ $p->id }}, nama: '{{ addslashes($p->nama_produk) }}', harga: {{ $p->harga }}, stok: {{ $p->stok }}, gambar: '{{ $p->gambar ? asset('storage/' . $p->gambar) : '' }}' })"
                                        class="mt-auto w-full py-1.5 rounded-lg text-xs font-medium transition-all duration-150"
                                        :class="isInCart({{ $p->id }})
                                                        ? 'bg-cyan-100 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400 border border-cyan-300 dark:border-cyan-700'
                                                        : 'bg-cyan-500 hover:bg-cyan-600 text-white'">
                                        <span x-text="isInCart({{ $p->id }}) ? '+ Tambah Lagi' : 'Tambah'"></span>
                                    </button>
                                @else
                                    <button type="button" disabled
                                        class="mt-auto w-full py-1.5 rounded-lg text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed">
                                        Stok Habis
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Keranjang -->
            <div x-show="cart.length > 0" x-transition
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 p-6">

                <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-4">
                    Keranjang (<span x-text="cart.length"></span> item)
                </h2>

                <div class="space-y-3">
                    <template x-for="(item, index) in cart" :key="item.id">
                        <div
                            class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-700/40 border border-gray-100 dark:border-gray-700">

                            <input type="hidden" :name="'produk[' + index + '][produk_id]'" :value="item.id">
                            <input type="hidden" :name="'produk[' + index + '][jumlah]'" :value="item.jumlah">

                            <!-- Foto -->
                            <div
                                class="w-12 h-12 rounded-lg overflow-hidden shrink-0 bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 flex items-center justify-center">
                                <template x-if="item.gambar">
                                    <img :src="item.gambar" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!item.gambar">
                                    <svg class="w-5 h-5 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </template>
                            </div>

                            <!-- Nama & harga -->
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate" x-text="item.nama">
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                    Rp <span x-text="item.harga.toLocaleString('id-ID')"></span> / pcs
                                </p>
                            </div>

                            <!-- Qty stepper -->
                            <div class="flex items-center gap-1.5 shrink-0">
                                <button type="button" @click="decreaseQty(index)"
                                    class="w-7 h-7 rounded-lg border border-gray-200 dark:border-gray-600
                                               bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-400
                                               hover:border-cyan-400 dark:hover:border-cyan-600 hover:text-cyan-600 dark:hover:text-cyan-400
                                               flex items-center justify-center text-sm font-bold transition-colors">−</button>
                                <span class="w-8 text-center text-sm font-semibold text-gray-900 dark:text-gray-100"
                                    x-text="item.jumlah"></span>
                                <button type="button" @click="increaseQty(index)"
                                    class="w-7 h-7 rounded-lg border border-gray-200 dark:border-gray-600
                                               bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-400
                                               hover:border-cyan-400 dark:hover:border-cyan-600 hover:text-cyan-600 dark:hover:text-cyan-400
                                               flex items-center justify-center text-sm font-bold transition-colors">+</button>
                            </div>

                            <!-- Subtotal -->
                            <div class="shrink-0 text-right min-w-[80px]">
                                <p class="text-sm font-semibold text-cyan-600 dark:text-cyan-400"
                                    x-text="'Rp ' + (item.harga * item.jumlah).toLocaleString('id-ID')"></p>
                            </div>

                            <!-- Hapus -->
                            <button type="button" @click="removeFromCart(index)" class="shrink-0 p-1.5 rounded-lg text-gray-400 dark:text-gray-500
                                           hover:text-red-500 dark:hover:text-red-400
                                           hover:bg-red-50 dark:hover:bg-red-900/20
                                           transition-colors duration-150">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>

                <!-- Total -->
                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Harga</span>
                    <span class="text-xl font-bold text-green-600 dark:text-green-400"
                        x-text="'Rp ' + totalHarga().toLocaleString('id-ID')"></span>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                               bg-gradient-to-r from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700
                               text-white font-medium rounded-xl shadow-lg shadow-cyan-500/30
                               transition-all duration-300 transform hover:-translate-y-0.5
                               disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                :disabled="cart.length === 0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Transaksi
            </button>

        </form>
    </div>

    <script>
        function penjualanForm() {
            return {
                cart: [],
                search: '',
                filterStok: 'semua',

                init() { },

                isVisible(id, nama, stok) {
                    const matchSearch = this.search === '' || nama.includes(this.search.toLowerCase());
                    const matchFilter =
                        this.filterStok === 'semua' ||
                        (this.filterStok === 'tersedia' && stok > 0) ||
                        (this.filterStok === 'habis' && stok <= 0);
                    return matchSearch && matchFilter;
                },

                filteredProduk() {
                    // Dummy — hanya untuk cek apakah ada produk terlihat
                    return [1];
                },

                isInCart(id) {
                    return this.cart.some(function (item) { return item.id === id; });
                },

                getQty(id) {
                    var item = this.cart.find(function (item) { return item.id === id; });
                    return item ? item.jumlah : 0;
                },

                addToCart(product) {
                    if (product.stok <= 0) {
                        alert('Stok produk ini sudah habis!');
                        return;
                    }
                    var existing = this.cart.find(function (item) { return item.id === product.id; });
                    if (existing) {
                        if (existing.jumlah >= product.stok) {
                            alert('Stok ' + product.nama + ' hanya tersedia ' + product.stok + ' unit.');
                            return;
                        }
                        existing.jumlah++;
                    } else {
                        this.cart.push(Object.assign({}, product, { jumlah: 1 }));
                    }
                },

                removeFromCart(index) {
                    this.cart.splice(index, 1);
                },

                increaseQty(index) {
                    var item = this.cart[index];
                    if (item.jumlah >= item.stok) {
                        alert('Stok ' + item.nama + ' hanya tersedia ' + item.stok + ' unit.');
                        return;
                    }
                    item.jumlah++;
                },

                decreaseQty(index) {
                    var item = this.cart[index];
                    if (item.jumlah <= 1) {
                        if (confirm('Hapus ' + item.nama + ' dari keranjang?')) {
                            this.removeFromCart(index);
                        }
                        return;
                    }
                    item.jumlah--;
                },

                totalHarga() {
                    return this.cart.reduce(function (sum, item) {
                        return sum + (item.harga * item.jumlah);
                    }, 0);
                }
            }
        }
    </script>

@endsection