<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cashier System') - Sistem Kasir</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Dark Mode Script -->
    <script>
        // Check for saved theme preference or default to system preference
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-navy-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    
    @auth
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            @include('components.sidebar')
            
            <!-- Main Content -->
            <div class="flex-1 flex flex-col lg:ml-64">
                <!-- Navbar -->
                @include('components.navbar')
                
                <!-- Main -->
                <main class="flex-1 p-4 lg:p-8">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-aqua-100 dark:bg-aqua-900/30 border border-aqua-400 dark:border-aqua-600 text-aqua-800 dark:text-aqua-200 rounded-xl animate-fade-in">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-800 dark:text-red-200 rounded-xl animate-fade-in">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 text-red-800 dark:text-red-200 rounded-xl animate-fade-in">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @yield('content')
                </main>
                
                <!-- Footer -->
                @include('components.footer')
            </div>
        </div>
    @else
        <div class="min-h-screen">
            @yield('content')
        </div>
    @endauth
    
</body>
</html>
