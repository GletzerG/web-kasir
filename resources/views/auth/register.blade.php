<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cashier System</title>
    
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
<body class="font-sans antialiased bg-gradient-to-br from-aqua-50 via-white to-aqua-100 dark:from-navy-950 dark:via-navy-900 dark:to-navy-800 min-h-screen flex items-center justify-center p-4 transition-colors duration-300">
    
    <!-- Dark Mode Toggle -->
    <button 
        x-data="darkMode()"
        @click="toggle()"
        class="fixed top-4 right-4 p-2.5 rounded-xl bg-white dark:bg-navy-800 shadow-lg shadow-gray-200/50 dark:shadow-none text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-navy-700 transition-all duration-300 border border-gray-200 dark:border-navy-700 z-50"
        :title="isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
    >
        <svg x-show="isDark" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        <svg x-show="!isDark" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
        </svg>
    </button>
    
    <!-- Back Button -->
    <a 
        href="{{ route('welcome') }}" 
        class="fixed top-4 left-4 p-2.5 rounded-xl bg-white dark:bg-navy-800 shadow-lg shadow-gray-200/50 dark:shadow-none text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-navy-700 transition-all duration-300 border border-gray-200 dark:border-navy-700 z-50 flex items-center gap-2"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        <span class="hidden sm:inline">Kembali</span>
    </a>
    
    <!-- Register Card -->
    <div class="w-full max-w-md animate-fade-in">
        <div class="bg-white dark:bg-navy-800 rounded-3xl shadow-2xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-navy-700 p-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-aqua-400 to-aqua-600 flex items-center justify-center shadow-lg shadow-aqua-500/30 mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Buat Akun</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Daftar untuk memulai</p>
            </div>
            
            <!-- Flash Messages -->
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-800 dark:text-red-200 rounded-xl">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            required
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-navy-600 bg-white dark:bg-navy-700 text-gray-900 dark:text-black placeholder-gray-400 focus:ring-2 focus:ring-aqua-400 focus:border-aqua-400 dark:focus:ring-aqua-500 dark:focus:border-aqua-500 transition-all duration-200"
                            placeholder="John Doe"
                        >
                    </div>
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-navy-600 bg-white dark:bg-navy-700 text-gray-900 dark:text-black placeholder-gray-400 focus:ring-2 focus:ring-aqua-400 focus:border-aqua-400 dark:focus:ring-aqua-500 dark:focus:border-aqua-500 transition-all duration-200"
                            placeholder="nama@email.com"
                        >
                    </div>
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Password
                        <span class="text-xs text-gray-500 dark:text-gray-400">(min. 8 karakter)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            minlength="8"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-navy-600 bg-white dark:bg-navy-700 text-gray-900 dark:text-black placeholder-gray-400 focus:ring-2 focus:ring-aqua-400 focus:border-aqua-400 dark:focus:ring-aqua-500 dark:focus:border-aqua-500 transition-all duration-200"
                            placeholder="••••••••"
                        >
                                                    <!-- Button eye -->
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                🫣
                            </button>
                    </div>
                </div>
                
                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            minlength="8"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-navy-600 bg-white dark:bg-navy-700 text-gray-900 dark:text-black placeholder-gray-400 focus:ring-2 focus:ring-aqua-400 focus:border-aqua-400 dark:focus:ring-aqua-500 dark:focus:border-aqua-500 transition-all duration-200"
                            placeholder="••••••••"
                        >
                            {{-- <!-- Button eye -->
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                🫣
                            </button> --}}

                    </div>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-gradient-to-r from-aqua-500 to-aqua-600 hover:from-aqua-600 hover:to-aqua-700 text-white font-semibold rounded-xl shadow-lg shadow-aqua-500/30 hover:shadow-aqua-500/50 transition-all duration-300 transform hover:-translate-y-0.5"
                >
                    Daftar
                </button>
            </form>
            
            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-medium text-aqua-600 dark:text-aqua-400 hover:text-aqua-700 dark:hover:text-aqua-300 transition-colors">
                        Login sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
    
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
    <script>
        function togglePassword() {
            const input = document.getElementById("password");

            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        
        }
    </script>
</body>
</html>
