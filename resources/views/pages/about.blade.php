@extends('layouts.app')

@section('title')
    <title>Tentang Kami - Python Gampang</title>
@endsection

@section('content')

    <div class="relative bg-blue-700 py-20 overflow-hidden">
        <div class="absolute top-0 left-0 w-64 h-64 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 translate-x-1/2 translate-y-1/2"></div>

        <div class="relative max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Membuka Pintu Dunia Coding <br/>
                <span class="text-orange-400">Untuk Siapa Saja</span>
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
                Kami percaya bahwa belajar pemrograman tidak harus rumit, mahal, atau terhalang kendala bahasa.
            </p>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Team working" class="rounded-2xl shadow-xl shadow-blue-900/10">
                </div>
                <div class="w-full md:w-1/2 space-y-6">
                    <h2 class="text-3xl font-bold text-gray-800">
                        Cerita <span class="text-blue-600">Python Gampang</span>
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Banyak pemula menyerah belajar coding bahkan sebelum menulis baris kode pertama mereka. Masalahnya? Instalasi yang rumit, error konfigurasi, dan materi berbahasa Inggris yang sulit dipahami.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Itulah mengapa kami membangun <b>Python Gampang</b>. Sebuah platform di mana Anda bisa belajar teori dan langsung mempraktikkannya di browser—tanpa instalasi apapun.
                    </p>
                    
                    <div class="pt-4 border-l-4 border-orange-500 pl-6">
                        <p class="text-lg font-medium text-gray-800 italic">
                            "Visi kami sederhana: Mencetak talenta digital Indonesia yang siap bersaing di era AI, dimulai dari langkah kecil bernama Python."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Nilai Utama Kami</h2>
                <p class="text-gray-500 mt-2">Apa yang membedakan kami dari tutorial lain?</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">100% Bahasa Indonesia</h3>
                    <p class="text-gray-600">Materi disusun dengan analogi lokal yang mudah dimengerti, bukan sekadar terjemahan kaku dari buku teks asing.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Interaktif & Praktis</h3>
                    <p class="text-gray-600">Teori itu penting, tapi praktik segalanya. Editor kode kami memastikan Anda memahami logika, bukan sekadar menghafal.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Kurikulum Modern</h3>
                    <p class="text-gray-600">Materi kami terus diperbarui mengikuti perkembangan Python terbaru.</p>
                </div>
            </div>
        </div>
    </div>

@endsection