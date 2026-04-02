<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier System - Sistem Kasir Modern</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Dark Mode Script -->
    <script>
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-aqua-50 via-white to-aqua-100 dark:from-navy-950 dark:via-navy-900 dark:to-navy-800 min-h-screen transition-colors duration-300">
    
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-aqua-400 to-aqua-600 flex items-center justify-center shadow-lg shadow-aqua-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-aqua-600 to-aqua-800 dark:from-aqua-400 dark:to-aqua-500 bg-clip-text text-transparent">
                        MyJourney
                    </span>
                </div>
                
                <!-- Dark Mode Toggle -->
                <button 
                    x-data="darkMode()"
                    @click="toggle()"
                    class="p-2.5 rounded-xl bg-white dark:bg-navy-800 shadow-lg shadow-gray-200/50 dark:shadow-none text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-navy-700 transition-all duration-300 border border-gray-200 dark:border-navy-700"
                    :title="isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
                >
                    <!-- Sun Icon -->
                    <svg x-show="isDark" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <!-- Moon Icon -->
                    <svg x-show="!isDark" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <main class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center animate-fade-in">
                <!-- Logo Large -->
                <div class="flex justify-center mb-8">
                    <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-aqua-400 to-aqua-600 flex items-center justify-center shadow-2xl shadow-aqua-500/40">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Title -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-4">
                    <span class="bg-gradient-to-r from-aqua-600 to-aqua-800 dark:from-aqua-400 dark:to-aqua-500 bg-clip-text text-transparent">
                        Cashier System
                    </span>
                </h1>
                
                <!-- Description -->
                <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300 mb-4 max-w-2xl mx-auto">
                    Sistem Kasir Modern untuk Mengelola Bisnis Anda
                </p>
                <p class="text-gray-500 dark:text-gray-400 mb-10 max-w-xl mx-auto">
                    Kelola produk, pelanggan, dan penjualan dengan mudah. 
                    Desain modern dengan dukungan light & dark mode untuk kenyamanan pengguna.
                </p>
                
                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a 
                        href="{{ route('login') }}" 
                        class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-aqua-500 to-aqua-600 hover:from-aqua-600 hover:to-aqua-700 text-white font-semibold rounded-2xl shadow-lg shadow-aqua-500/30 hover:shadow-aqua-500/50 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login
                    </a>
                    <a 
                        href="{{ route('register') }}" 
                        class="w-full sm:w-auto px-8 py-4 bg-white dark:bg-navy-800 hover:bg-gray-50 dark:hover:bg-navy-700 text-gray-700 dark:text-gray-200 font-semibold rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-200 dark:border-navy-700 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Register
                    </a>
                </div>
                
                <!-- Features -->
                <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-6 bg-white dark:bg-navy-800/50 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-navy-700 card-hover">
                        <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-aqua-100 dark:bg-aqua-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-aqua-600 dark:text-aqua-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Kelola Produk</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tambah, edit, dan hapus produk dengan mudah</p>
                    </div>
                    
                    <div class="p-6 bg-white dark:bg-navy-800/50 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-navy-700 card-hover">
                        <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-aqua-100 dark:bg-aqua-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-aqua-600 dark:text-aqua-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Data Pelanggan</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Simpan dan kelola data pelanggan Anda</p>
                    </div>
                    
                    <div class="p-6 bg-white dark:bg-navy-800/50 rounded-2xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-navy-700 card-hover">
                        <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-aqua-100 dark:bg-aqua-900/30 flex items-center justify-center">
                            <svg class="w-6 h-6 text-aqua-600 dark:text-aqua-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Transaksi</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Catat penjualan dengan otomatisasi stok</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="py-6 px-4 text-center">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} Cashier System. Built with Laravel 12 & Tailwind CSS
        </p>
    </footer>
    
    <script>
        function darkMode() {
            return {
                isDark: document.documentElement.classList.contains('dark'),
                toggle() {
                    this.isDark = !this.isDark;
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    }
                }
            }
        }
    </script>
</body>
</html>
