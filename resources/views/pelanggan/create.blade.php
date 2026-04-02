@extends('layouts.app')

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

        .form-textarea {
            resize: none;
            min-height: 80px;
        }
    </style>

    <div class="max-w-2xl px-6 py-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-1.5 text-xs text-slate-400 dark:text-gray-500 mb-6">
            <a href="{{ route('pelanggan.index') }}" class="text-teal-600 dark:text-aqua-400 hover:underline">Pelanggan</a>
            <span>/</span>
            <span class="text-slate-700 dark:text-gray-300">Tambah Pelanggan</span>
        </nav>

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Tambah Pelanggan</h1>
            <p class="text-sm text-slate-400 dark:text-gray-400 mt-0.5">Isi data pelanggan baru di bawah ini</p>
        </div>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div
                class="flex items-start gap-2.5 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg px-4 py-3 mb-5 text-sm text-red-700 dark:text-red-400">
                <span class="mt-0.5">⚠️</span>
                <ul class="space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Card Form --}}
        <div class="bg-white dark:bg-navy-800 border border-slate-200 dark:border-navy-700 rounded-xl p-7">
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf

                {{-- Nama --}}
                <div class="mb-5">
                    <label for="nama" class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5">
                        Nama Pelanggan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}"
                        placeholder="Nama lengkap pelanggan"
                        class="form-input @error('nama_pelanggan') !border-red-400 @enderror" required>
                    @error('nama_pelanggan')
                        <p class="text-xs text-red-500 dark:text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-5">
                    <label for="alamat"
                        class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap"
                        class="form-textarea">{{ old('alamat') }}</textarea>
                </div>

                {{-- No HP --}}
                <div class="mb-6">
                    <label for="telepon" class="block text-sm font-medium text-slate-700 dark:text-gray-300 mb-1.5">No
                        HP</label>
                    <input type="text" id="telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                        placeholder="08xx xxxx xxxx" class="form-input">
                </div>

                <hr class="border-slate-100 dark:border-navy-700 mb-5">

                {{-- Actions --}}
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="bg-aqua-400 hover:bg-aqua-500 dark:bg-aqua-500 dark:hover:bg-aqua-600 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition">
                        Simpan
                    </button>
                    <a href="{{ route('pelanggan.index') }}"
                        class="border border-slate-200 dark:border-navy-600 hover:bg-slate-50 dark:hover:bg-navy-700 text-slate-500 dark:text-gray-400 hover:text-slate-700 dark:hover:text-white text-sm px-4 py-2.5 rounded-lg transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection