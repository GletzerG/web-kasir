<nav class="bg-white dark:bg-navy-800 border-b border-gray-200 dark:border-navy-700 sticky top-0 z-30">
    <div class="px-4 lg:px-8 py-4">
        <div class="flex items-center justify-between">
            <!-- Left: Mobile Menu Button -->
            <button 
                x-data="{ open: false }"
                @click="$dispatch('toggle-sidebar')"
                class="lg:hidden p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-navy-700 transition-colors"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <!-- Center: Page Title (Mobile) -->
            <div class="lg:hidden font-semibold text-gray-800 dark:text-white">
                @yield('page-title', 'Dashboard')
            </div>
            
            <!-- Right: Actions -->
            <div class="flex items-center gap-4">
                <!-- Dark Mode Toggle -->
                <button 
                    x-data="darkMode()"
                    @click="toggle()"
                    class="p-2 rounded-xl bg-gray-900 dark:bg-navy-700 text-gray-100 dark:text-gray-300 hover:bg-aqua-400 dark:hover:bg-navy-600 transition-all duration-300"
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
                
                <!-- User Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button 
                        @click="open = !open"
                        @click.away="open = false"
                        class="flex items-center gap-3 p-2 rounded-xl hover:bg-aqua-400 dark:hover:bg-navy-700 transition-colors"
                    >
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-aqua-400 to-aqua-600 flex items-center justify-center text-white font-semibold text-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ auth()->user()->name }}
                        </span>
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div 
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-navy-800 rounded-xl shadow-lg border border-gray-200 dark:border-navy-700 py-2 z-50"
                    >
                        <div class="px-4 py-2 border-b border-gray-200 dark:border-navy-700">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                        
                        <form action="{{ route('logout') }}" method="POST" class="px-2 py-1">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

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
