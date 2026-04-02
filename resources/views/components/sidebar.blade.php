<!-- Mobile Sidebar Overlay -->
<div 
    x-data="{ open: false }"
    x-show="open"
    @toggle-sidebar.window="open = !open"
    class="fixed inset-0 z-40 lg:hidden"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display: none;"
>
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="open = false"></div>
</div>

<!-- Sidebar -->
<aside 
    x-data="{ open: false }"
    x-show="open || window.innerWidth >= 1024"
    @toggle-sidebar.window="open = !open"
    :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
    class="fixed left-0 top-0 z-50 h-screen w-64 bg-white dark:bg-navy-800 border-r border-gray-200 dark:border-navy-700 transform transition-transform duration-300 lg:translate-x-0"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
>
    <!-- Logo -->
    <div class="h-16 flex items-center justify-center border-b border-gray-200 dark:border-navy-700">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-aqua-400 to-aqua-600 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <span class="text-xl font-bold bg-gradient-to-r from-aqua-500 to-aqua-700 dark:from-aqua-400 dark:to-aqua-500 bg-clip-text text-transparent">
                MyJourney
            </span>
        </a>
    </div>
    
    <!-- Navigation -->
    <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-4rem)]">
        <!-- Dashboard -->
        <a 
            href="{{ route('dashboard') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-aqua-50 dark:bg-aqua-900/30 text-aqua-600 dark:text-aqua-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-aqua-500 dark:hover:bg-navy-700 hover:text-gray-900 dark:hover:text-white' }}"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Dashboard
        </a>
        
        <!-- Produk -->
        <a 
            href="{{ route('produk.index') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('produk.*') ? 'bg-aqua-50 dark:bg-aqua-900/30 text-aqua-600 dark:text-aqua-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-aqua-500 dark:hover:bg-navy-700 hover:text-gray-900 dark:hover:text-white' }}"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Produk
        </a>
        
        <!-- Pelanggan -->
        <a 
            href="{{ route('pelanggan.index') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('pelanggan.*') ? 'bg-aqua-50 dark:bg-aqua-900/30 text-aqua-600 dark:text-aqua-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-aqua-500 dark:hover:bg-navy-700 hover:text-gray-900 dark:hover:text-white' }}"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Pelanggan
        </a>
        
        <!-- Penjualan -->
        <a 
            href="{{ route('penjualan.index') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('penjualan.*') ? 'bg-aqua-50 dark:bg-aqua-900/30 text-aqua-600 dark:text-aqua-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-aqua-500 dark:hover:bg-navy-700 hover:text-gray-900 dark:hover:text-white' }}"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            Penjualan
        </a>
        
        <!-- Divider -->
        <div class="my-4 border-t border-gray-200 dark:border-navy-700"></div>

        <!-- faq -->
        <a 
            href="{{ route('faq.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('faq') ? 'bg-aqua-50 dark:bg-aqua-900/30 text-aqua-600 dark:text-aqua-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-aqua-500 dark:hover:bg-navy-700 hover:text-gray-900 dark:hover:text-white' }}"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 1.591-2 2.772-2 1.657 0 3 .994 3 2.236 0 1.141-.26 1.763-1.042 2.712-.522.637-.805 1.319-.805 2.088v.002c0 .554.448 1.002 1 1.002s1-.448 1-1.002V16c0-1.113.26-1.726 1.042-2.712C15.73 12.987 16 12.305 16 11.526 16 9.745 14.209 8 12.001 8c-1.181 0-2.232.835-2.772 2zM12 18h.01"></path>
            </svg>
            FAQ
        </a>    

        <div class="my-4 border-t border-gray-200 dark:border-navy-700"></div>
        
        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </button>
        </form>
    </nav>
</aside>
