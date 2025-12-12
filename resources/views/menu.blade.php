<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PyBot Explorer | Peta Dunia</title>
    {{-- Asumsi Tailwind sudah terintegrasi --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Tambahan untuk sentuhan anak-anak */
        .game-font {
            font-family: 'Comic Sans MS', cursive; /* Gunakan font yang cheerful/playful */
            text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="game-font">

    <div class="min-h-screen bg-gradient-to-br from-sky-400 to-indigo-500 p-4 sm:p-8">

        {{-- === 1. Header & Informasi Siswa === --}}
        <header class="flex justify-between items-center mb-8 p-4 bg-yellow-300 rounded-full shadow-2xl border-4 border-yellow-500 transform rotate-1">
            
            {{-- Nama Siswa & Avatar --}}
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-pink-500 rounded-full border-4 border-white flex items-center justify-center text-xl text-white font-extrabold">
                    {{-- Avatar Inisial atau Icon --}}
                    🤖
                </div>
                <h1 class="text-xl sm:text-2xl text-indigo-900 font-extrabold tracking-tight">
                    Hai, {{ Auth::user()->name ?? 'Petualang Kecil' }}!
                </h1>
            </div>

            {{-- Koin / Progress --}}
            <div class="bg-white px-4 py-2 rounded-full shadow-lg border-2 border-green-500">
                <span class="text-lg sm:text-xl font-extrabold text-green-700">💰 Koin Kode:</span> 
                <span class="text-xl sm:text-2xl font-black text-yellow-600">{{ $koin_kode ?? '150' }}</span>
            </div>
        </header>

        {{-- === 2. Area Peta Dunia (Container Utama) === --}}
        <main class="grid gap-6 md:grid-cols-3 md:gap-10 mt-10">

            {{-- --- Modul 1: Modul Materi (Pondasi Kode) --- --}}
            <a 
               class="p-6 bg-pink-500 hover:bg-pink-400 rounded-[3rem] shadow-2xl border-8 border-white transform hover:scale-105 transition duration-300 ease-in-out text-center 
                      flex flex-col justify-center items-center h-56 sm:h-72" 
               style="clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);"
            >
                <div class="text-6xl mb-2">📚</div>
                <h2 class="text-3xl font-extrabold text-white uppercase mt-2">Pondasi Kode</h2>
                <p class="text-white text-sm font-semibold mt-1">Belajar Dasar Logika</p>
            </a>
            
            {{-- --- Modul 2: Modul Game (Arena PyBot) - Paling Menonjol --- --}}
            <a  
               class="md:col-span-1 p-8 bg-gradient-to-r from-red-600 to-orange-500 hover:from-red-500 hover:to-orange-400 
                      rounded-full shadow-[0_20px_50px_rgba(255,100,0,0.7)] border-8 border-yellow-300 
                      transform scale-105 hover:scale-110 transition duration-300 ease-in-out text-center 
                      flex flex-col justify-center items-center h-64 sm:h-80"
            >
                <div class="text-7xl animate-pulse">🚀</div>
                <h2 class="text-4xl font-black text-white uppercase mt-4">ARENA PYBOT</h2>
                <p class="text-white text-lg font-semibold mt-1">Mulai Petualangan Coding!</p>
            </a>

            {{-- --- Modul 3: Toko Kustomisasi --- --}}
            <a  
               class="p-6 bg-green-500 hover:bg-green-400 rounded-lg shadow-2xl border-8 border-white 
                      transform hover:scale-105 transition duration-300 ease-in-out text-center 
                      flex flex-col justify-center items-center h-56 sm:h-72" 
               style="clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);"
            >
                <div class="text-6xl mb-2">🎁</div>
                <h2 class="text-3xl font-extrabold text-white uppercase mt-2">Toko PyBot</h2>
                <p class="text-white text-sm font-semibold mt-1">Beli Skin & Item Baru</p>
            </a>

        </main>

        {{-- === 3. Footer (Akses Sekunder) === --}}
        <footer class="mt-16 text-center">
            <a  class="inline-block px-6 py-3 bg-white text-indigo-700 font-bold rounded-full shadow-lg hover:bg-gray-100 transform -rotate-2">
                🏆 Lihat Papan Peringkat
            </a>
        </footer>
    </div>

</body>
</html>