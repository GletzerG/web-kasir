@extends('layouts.app')

@section('title', 'FAQ')
@section('page-title', 'FAQ')

@section('content')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Pusat Bantuan</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Pertanyaan yang sering ditanyakan seputar sistem kasir</p>
            </div>
            {{-- Badge --}}
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-50 dark:bg-cyan-900/30 text-cyan-700 dark:text-cyan-300 text-sm font-medium rounded-xl border border-cyan-200 dark:border-cyan-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ count($faqs) }} Pertanyaan
            </span>
        </div>

        {{-- Filter Kategori --}}
        <div class="flex flex-wrap gap-2" id="filterTabs">
            <button onclick="filterFaq('semua', this)"
                class="faq-tab active-tab px-4 py-2 text-xs font-medium rounded-xl border border-cyan-500 bg-cyan-500 text-white transition">
                Semua
            </button>
            <button onclick="filterFaq('pelanggan', this)"
                class="faq-tab px-4 py-2 text-xs font-medium rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:border-cyan-400 dark:hover:border-cyan-600 hover:text-cyan-600 dark:hover:text-cyan-400 transition">
                Pelanggan
            </button>
            <button onclick="filterFaq('produk', this)"
                class="faq-tab px-4 py-2 text-xs font-medium rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:border-cyan-400 dark:hover:border-cyan-600 hover:text-cyan-600 dark:hover:text-cyan-400 transition">
                Produk
            </button>
            <button onclick="filterFaq('transaksi', this)"
                class="faq-tab px-4 py-2 text-xs font-medium rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:border-cyan-400 dark:hover:border-cyan-600 hover:text-cyan-600 dark:hover:text-cyan-400 transition">
                Transaksi
            </button>
            <button onclick="filterFaq('akun', this)"
                class="faq-tab px-4 py-2 text-xs font-medium rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:border-cyan-400 dark:hover:border-cyan-600 hover:text-cyan-600 dark:hover:text-cyan-400 transition">
                Akun
            </button>
        </div>

        {{-- Search --}}
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Cari pertanyaan..."
                class="w-full pl-9 pr-4 py-2.5 text-sm border border-slate-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500 transition">
        </div>

        {{-- FAQ List --}}
        <div class="space-y-3" id="faqList">

            @foreach ($faqs as $index => $faq)
                <div class="faq-item bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl overflow-hidden transition-all duration-200"
                    data-kategori="{{ $faq['kategori'] }}"
                    data-pertanyaan="{{ strtolower($faq['pertanyaan']) }}">

                    {{-- Pertanyaan --}}
                    <button type="button"
                        onclick="toggleFaq({{ $index }})"
                        class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <div class="flex items-center gap-3 flex-1 min-w-0">
                            {{-- Badge Kategori --}}
                            <span class="shrink-0 px-2.5 py-0.5 text-xs font-medium rounded-full
                                @if($faq['kategori'] === 'pelanggan') bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300
                                @elseif($faq['kategori'] === 'produk') bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300
                                @elseif($faq['kategori'] === 'transaksi') bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300
                                @else bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300
                                @endif">
                                {{ ucfirst($faq['kategori']) }}
                            </span>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $faq['pertanyaan'] }}
                            </span>
                        </div>
                        {{-- Icon Toggle --}}
                        <div class="faq-icon-wrap shrink-0 ml-3 w-7 h-7 flex items-center justify-center rounded-full border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 transition-all duration-200"
                            id="icon-{{ $index }}">
                            <svg class="w-3.5 h-3.5 text-gray-400 dark:text-gray-500 transition-transform duration-200" id="arrow-{{ $index }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                    </button>

                    {{-- Jawaban --}}
                    <div class="faq-answer hidden px-5 pb-4 border-t border-gray-100 dark:border-gray-700"
                        id="answer-{{ $index }}">
                        <p class="pt-4 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $faq['jawaban'] }}
                        </p>
                        @if (!empty($faq['poin']))
                            <ul class="mt-3 space-y-1.5">
                                @foreach ($faq['poin'] as $poin)
                                    <li class="flex items-start gap-2 text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="w-4 h-4 text-cyan-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $poin }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>
            @endforeach

        </div>

        {{-- Empty State --}}
        <div id="emptyFaq" class="hidden text-center py-16">
            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-gray-400 dark:text-gray-500">Tidak ada pertanyaan yang cocok.</p>
        </div>

        {{-- Footer --}}
        <p class="text-xs text-gray-400">
            {{ now()->format('d M Y, H:i') }} · {{ count($faqs) }} pertanyaan tersedia
        </p>

    </div>

    <script>
        // ── Toggle FAQ ───────────────────────────────────────────
        function toggleFaq(index) {
            const answer = document.getElementById('answer-' + index);
            const icon = document.getElementById('icon-' + index);
            const arrow = document.getElementById('arrow-' + index);
            const isOpen = !answer.classList.contains('hidden');

            if (isOpen) {
                answer.classList.add('hidden');
                icon.classList.remove('bg-cyan-500', 'border-cyan-500');
                icon.classList.add('bg-gray-50', 'dark:bg-gray-700', 'border-gray-200', 'dark:border-gray-600');
                arrow.style.transform = 'rotate(0deg)';
                arrow.classList.remove('text-white');
                arrow.classList.add('text-gray-400', 'dark:text-gray-500');
            } else {
                answer.classList.remove('hidden');
                icon.classList.add('bg-cyan-500', 'border-cyan-500');
                icon.classList.remove('bg-gray-50', 'dark:bg-gray-700', 'border-gray-200', 'dark:border-gray-600');
                arrow.style.transform = 'rotate(45deg)';
                arrow.classList.add('text-white');
                arrow.classList.remove('text-gray-400', 'dark:text-gray-500');
            }
        }

        // ── Filter Kategori ──────────────────────────────────────
        function filterFaq(kategori, btn) {
            // Update active tab style
            document.querySelectorAll('.faq-tab').forEach(tab => {
                tab.classList.remove('active-tab', 'bg-cyan-500', 'border-cyan-500', 'text-white');
                tab.classList.add('bg-white', 'dark:bg-gray-800', 'border-gray-200', 'dark:border-gray-600', 'text-gray-600', 'dark:text-gray-400');
            });
            btn.classList.add('active-tab', 'bg-cyan-500', 'border-cyan-500', 'text-white');
            btn.classList.remove('bg-white', 'dark:bg-gray-800', 'border-gray-200', 'dark:border-gray-600', 'text-gray-600', 'dark:text-gray-400');

            applyFilter();
        }

        // ── Search ───────────────────────────────────────────────
        document.getElementById('searchInput').addEventListener('input', applyFilter);

        function applyFilter() {
            const activeTab = document.querySelector('.active-tab');
            const kategori = activeTab ? activeTab.getAttribute('onclick').match(/'([^']+)'/)[1] : 'semua';
            const q = document.getElementById('searchInput').value.toLowerCase().trim();

            const items = document.querySelectorAll('.faq-item');
            let visible = 0;

            items.forEach(item => {
                const itemKategori = item.dataset.kategori;
                const itemPertanyaan = item.dataset.pertanyaan || '';
                const matchKategori = kategori === 'semua' || itemKategori === kategori;
                const matchSearch = q === '' || itemPertanyaan.includes(q);

                if (matchKategori && matchSearch) {
                    item.style.display = '';
                    visible++;
                } else {
                    item.style.display = 'none';
                }
            });

            document.getElementById('emptyFaq').classList.toggle('hidden', visible > 0);
        }
    </script>
@endsection