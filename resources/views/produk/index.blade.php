@extends('layouts.app')

@section('title', 'Produk')
@section('page-title', 'Produk')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Data Produk</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Manajemen inventori produk</p>
            </div>
            <a href="{{ route('produk.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white rounded-xl shadow-lg text-sm font-medium">
                + Tambah Produk
            </a>
        </div>

        {{-- Search & Bulk Actions --}}
        <div class="flex flex-col sm:flex-row gap-3">

            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari nama produk..."
                    class="w-full pl-9 pr-4 py-2.5 text-sm border border-slate-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 transition">
            </div>

            {{-- Bulk Delete Button (hidden by default) --}}
            <div id="bulkActions" class="hidden">
                <form id="bulkDeleteForm" action="{{ route('produk.bulk-destroy') }}" method="POST"
                    onsubmit="return confirmBulkDelete()">
                    @csrf
                    @method('DELETE')
                    <div id="selectedInputs"></div>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-xl transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus <span id="selectedCount">0</span> Produk
                    </button>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="dark:border-gray-700 dark:bg-gray-800 rounded-2xl shadow border overflow-hidden">
            <table class="w-full text-sm" id="produkTable">

                {{-- THEAD --}}
                <thead>
                    <tr class="dark:border-gray-700 dark:bg-gray-700 border-b text-gray-500 text-xs uppercase tracking-widest">
                        <th class="px-5 py-3 text-left w-10">
                            <input type="checkbox" id="selectAll"
                                class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-cyan-500 cursor-pointer accent-cyan-500">
                        </th>
                        <th class="px-5 py-3 text-left text-xs">No</th>
                        <th class="px-5 py-3 text-left text-xs">Gambar</th>
                        <th class="px-5 py-3 text-left text-xs">Nama Produk</th>
                        <th class="px-5 py-3 text-left text-xs">Harga</th>
                        <th class="px-5 py-3 text-left text-xs">Stok</th>
                        <th class="px-5 py-3 text-right text-xs">Aksi</th>
                    </tr>
                </thead>

                {{-- TBODY --}}
                <tbody>
                    @forelse ($produk as $index => $p)
                        <tr class="produk-row border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                            data-nama="{{ strtolower($p->nama_produk) }}">

                            {{-- Checkbox --}}
                            <td class="px-5 py-3">
                                <input type="checkbox" class="row-checkbox w-4 h-4 rounded border-gray-300 dark:border-gray-600 cursor-pointer accent-cyan-500"
                                    value="{{ $p->id }}">
                            </td>

                            {{-- No --}}
                            <td class="px-5 py-3 text-gray-400">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>

                            {{-- Gambar --}}
                            <td class="px-5 py-3">
                                @php $url = $p->gambar ? asset('storage/' . $p->gambar) : null; @endphp
                                @if ($url)
                                    <img src="{{ $url }}" class="w-14 h-14 object-cover rounded-lg border"
                                        onerror="this.onerror=null;this.src='https://via.placeholder.com/80?text=No+Image';">
                                @else
                                    <div class="w-14 h-14 flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-xs text-gray-400 rounded-lg">
                                        N/A
                                    </div>
                                @endif
                            </td>

                            {{-- Nama --}}
                            <td class="px-5 py-3 font-medium text-gray-900 dark:text-gray-100">
                                {{ $p->nama_produk }}
                            </td>

                            {{-- Harga --}}
                            <td class="px-5 py-3 text-cyan-600 dark:text-cyan-400">
                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                            </td>

                            {{-- Stok --}}
                            <td class="px-5 py-3">
                                @if ($p->stok > 10)
                                    <span class="px-2 py-1 text-xs bg-cyan-100 text-cyan-700 rounded-full">{{ $p->stok }}</span>
                                @elseif ($p->stok > 0)
                                    <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">{{ $p->stok }}</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full">Habis</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-3 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('produk.edit', $p->id) }}"
                                        class="px-3 py-1 text-xs bg-cyan-100 text-cyan-700 hover:bg-cyan-200 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 text-xs bg-red-100 text-red-600 hover:bg-red-200 rounded-lg transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-400">
                                Belum ada produk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Empty search state --}}
            <div id="emptySearch" class="hidden text-center py-10 text-gray-400 text-sm">
                Tidak ada produk yang cocok dengan pencarian.
            </div>
        </div>

        {{-- Footer --}}
        <p class="text-xs text-gray-400">
            {{ now()->format('d M Y, H:i') }} · {{ count($produk) }} produk
        </p>

    </div>

    <script>
        // ── Search ──────────────────────────────────────────────
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('.produk-row');
        const emptySearch = document.getElementById('emptySearch');

        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach(row => {
                const nama = row.dataset.nama || '';
                const match = nama.includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            emptySearch.classList.toggle('hidden', visible > 0);
        });

        // ── Bulk Select ─────────────────────────────────────────
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.row-checkbox');
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');
        const selectedInputs = document.getElementById('selectedInputs');

        function updateBulkUI() {
            const checked = document.querySelectorAll('.row-checkbox:checked');
            const count = checked.length;

            selectedCount.textContent = count;
            bulkActions.classList.toggle('hidden', count === 0);

            // Sync select-all state
            selectAll.indeterminate = count > 0 && count < checkboxes.length;
            selectAll.checked = count === checkboxes.length && checkboxes.length > 0;

            // Rebuild hidden inputs for form
            selectedInputs.innerHTML = '';
            checked.forEach(cb => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = cb.value;
                selectedInputs.appendChild(input);
            });
        }

        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => {
                // Only check visible rows
                const row = cb.closest('tr');
                if (row && row.style.display !== 'none') {
                    cb.checked = this.checked;
                }
            });
            updateBulkUI();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateBulkUI);
        });

        function confirmBulkDelete() {
            const count = document.querySelectorAll('.row-checkbox:checked').length;
            return confirm(`Yakin ingin menghapus ${count} produk yang dipilih?`);
        }
    </script>
@endsection