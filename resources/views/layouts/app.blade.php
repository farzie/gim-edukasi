<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title', 'PyGam - Belajar Coding Python dari Nol')
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group shrink-0">
                        <svg class="w-8 h-8 text-blue-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        <span class="text-2xl font-bold text-blue-800 tracking-tight">
                            Python<span class="text-orange-500">Gampang</span>
                        </span>
                    </a>
                    
                    <div class="hidden md:flex ml-12 space-x-8">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 transition-colors {{ request()->routeIs('home') ? 'text-blue-600 border-orange-500' : 'text-gray-500 border-transparent hover:text-blue-600 hover:border-orange-500' }}">
                            Beranda
                        </a>
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 transition-colors {{ request()->routeIs('courses.*') ? 'text-blue-600 border-orange-500' : 'text-gray-500 border-transparent hover:text-blue-600 hover:border-orange-500' }}">
                            Kurikulum
                        </a>
                        <a href="{{ route('about') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium border-b-2 transition-colors {{ request()->routeIs('about') ? 'text-blue-600 border-orange-500' : 'text-gray-500 border-transparent hover:text-blue-600 hover:border-orange-500' }}">
                            Tentang Kami
                        </a>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <div class="flex flex-col items-end mr-2">
                            <span class="text-xs text-gray-500">Selamat datang,</span>
                            <span class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                        </div>
                        
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg font-medium">
                            Dashboard
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-red-500 p-2 transition" title="Logout">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    @else
                        <span class="text-sm text-gray-500 mr-2">Mau belajar?</span>
                        <a href="{{ route('login') }}" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-6 py-2.5 rounded-full">
                            Masuk Akun
                        </a>
                    @endauth
                </div>

                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button" id="mobile-menu-btn" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden md:hidden bg-white border-t border-gray-100" id="mobile-menu">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                    Beranda
                </a>
                <a href="{{ route('courses.index') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('courses.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                    Kurikulum
                </a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                    Tentang Kami
                </a>

                <div class="border-t border-gray-200 mt-4 pt-4">
                    @auth
                        <div class="flex items-center px-3 mb-3">
                            <div class="ml-1">
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                            Dashboard Saya
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 mt-2 rounded-lg font-bold bg-orange-500 text-white shadow hover:bg-orange-600">
                            Masuk Akun
                        </a>
                        <a href="#" class="block w-full text-center px-4 py-3 mt-2 rounded-lg font-bold bg-gray-100 text-gray-700 hover:bg-gray-200">
                            Daftar Baru
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-slate-300 border-t-4 border-orange-500 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-white flex items-center justify-center md:justify-start gap-2">
                        Python<span class="text-orange-500">Gampang</span>
                    </h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Media pembelajaran pemrograman Python berbahasa Indonesia yang interaktif dan mudah dipahami untuk pemula hingga mahir.
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Akses Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-orange-400 transition">Beranda</a></li>
                        <li><a href="{{ route('courses.index') }}" class="hover:text-orange-400 transition">Kurikulum</a></li>
                        <li><a href="{{ route('playground') }}" class="hover:text-orange-400 transition">Code Editor</a></li>
                        <li><a href="{{ route('help') }}" class="hover:text-orange-400 transition">Bantuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Hubungi Kami</h4>
                    <p class="text-sm text-slate-400 mb-2">Punya pertanyaan seputar materi?</p>
                    <a href="mailto:farziexemail@gmail.com" class="inline-flex items-center text-orange-400 hover:text-orange-300 transition font-medium">
                        farziexemail@gmail.com &rarr;
                    </a>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-sm text-slate-500">
                <p>&copy; {{ date('Y') }} PyGam. Dibuat dengan <span class="text-red-500">&hearts;</span> untuk pengetahuan.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        });
    </script>

</body>
</html>