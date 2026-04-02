@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')
    <style>
        /* Paksa warna teks & background input di dark mode */
        .dark .form-input,
        .dark .form-textarea {
            background-color: #1a3045 !important;
            color: #ffffff !important;
            border-color: #2a4a60 !important;
        }

        .dark .form-input::placeholder,
        .dark .form-textarea::placeholder {
            color: #4a7080 !important;
        }

        /* Light mode */
        .form-input,
        .form-textarea {
            background-color: #ffffff;
            color: #0f172a;
            border-color: #e2e8f0;
        }

        /* Fix autofill */
        .dark .form-input:-webkit-autofill,
        .dark .form-input:-webkit-autofill:hover,
        .dark .form-input:-webkit-autofill:focus {
            -webkit-text-fill-color: #ffffff !important;
            -webkit-box-shadow: 0 0 0px 1000px #1a3045 inset !important;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            border-width: 1px;
            border-style: solid;
            border-radius: 0.5rem;
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input:focus,
        .form-textarea:focus {
            box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.2);
            border-color: #0d9488;
        }

        .dark .form-input:focus,
        .dark .form-textarea:focus {
            box-shadow: 0 0 0 2px rgba(77, 217, 217, 0.2);
            border-color: #4dd9d9;
        }

        /* File input dark mode */
        .dark .form-file {
            background-color: #1a3045 !important;
            color: #ffffff !important;
            border-color: #2a4a60 !important;
        }

        .form-file {
            width: 100%;
            border-width: 1px;
            border-style: solid;
            border-radius: 0.5rem;
            padding: 0.5rem 0.875rem;
            font-size: 0.875rem;
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
            border-color: #e2e8f0;
            background-color: #ffffff;
            color: #0f172a;
        }

        .dark .form-file::file-selector-button {
            background-color: #2a4a60;
            color: #ffffff;
            border: none;
            padding: 0.3rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 0.75rem;
        }

        .form-file:focus {
            box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.2);
            border-color: #0d9488;
        }

        .dark .form-file:focus {
            box-shadow: 0 0 0 2px rgba(77, 217, 217, 0.2);
            border-color: #4dd9d9;
        }
    </style>

    <div class="flex justify-center min-h-[80vh] px-4">
        <div class="w-full max-w-xl space-y-6">

            {{-- Header --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Produk</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Tambahkan produk baru ke dalam sistem</p>
            </div>

            {{-- Error Alert --}}
            @if ($errors->any())
                <div
                    class="flex items-start gap-2.5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg px-4 py-3 text-sm text-red-700 dark:text-red-400">
                    <span class="mt-0.5">⚠️</span>
                    <ul class="space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Card --}}
            <div class="bg-white dark:bg-navy-800 border border-slate-200 dark:border-navy-700 p-7 rounded-xl">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    {{-- Nama Produk --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Nama produk"
                            class="form-input @error('nama_produk') !border-red-400 @enderror">
                        @error('nama_produk')
                            <p class="text-xs text-red-500 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="harga" value="{{ old('harga') }}" placeholder="0"
                            class="form-input @error('harga') !border-red-400 @enderror">
                        @error('harga')
                            <p class="text-xs text-red-500 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stok" value="{{ old('stok') }}" placeholder="0"
                            class="form-input @error('stok') !border-red-400 @enderror">
                        @error('stok')
                            <p class="text-xs text-red-500 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Gambar --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5">Gambar</label>
                        <input type="file" name="gambar" id="gambarInput" accept="image/*"
                            class="form-file @error('gambar') !border-red-400 @enderror">
                        @error('gambar')
                            <p class="text-xs text-red-500 dark:text-red-400 mt-1">{{ $message }}</p>
                        @enderror

                        {{-- Preview --}}
                        <div class="mt-3">
                            <img id="preview"
                                class="w-24 h-24 object-cover rounded-lg hidden border border-slate-200 dark:border-navy-600">
                        </div>
                    </div>

                    <hr class="border-slate-100 dark:border-navy-700">

                    {{-- Actions --}}
                    <div class="flex items-center gap-3">
                        <button type="submit"
                            class="bg-aqua-400 hover:bg-aqua-500 dark:bg-aqua-500 dark:hover:bg-aqua-600 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">
                            Simpan Produk
                        </button>
                        <a href="{{ route('produk.index') }}"
                            class="border border-slate-200 dark:border-navy-600 hover:bg-slate-50 dark:hover:bg-navy-700 text-slate-500 dark:text-gray-400 hover:text-slate-700 dark:hover:text-white text-sm px-4 py-2.5 rounded-lg transition">
                            Batal
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <script>
        const input = document.getElementById('gambarInput');
        const preview = document.getElementById('preview');

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection