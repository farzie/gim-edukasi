@extends('layouts.app')

@section('title')
<title>PyGam - Belajar Coding Python dari Nol</title>
@endsection

@section('content')
    <div class="relative bg-white py-24 overflow-hidden">
        
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -translate-x-1/2 -translate-y-1/2 animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 translate-x-1/2 translate-y-1/2 animate-blob animation-delay-2000"></div>

        <div class="relative max-w-4xl mx-auto text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
                Kuasai Python <br class="hidden md:block" />
                <span class="text-blue-600">dari Nol sampai Mahir</span>
            </h1>
            <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                Media pembelajaran interaktif dengan fitur <b>live code editor</b>. 
                Belajar teori langsung praktik di browser tanpa instalasi rumit.
            </p>
            
            <div class="flex justify-center">
                <a href="{{ route('courses.index') }}" class="bg-blue-600 text-white px-10 py-4 rounded-full text-lg font-bold shadow-lg hover:bg-blue-700 hover:shadow-blue-500/30 transition">
                    Mulai Belajar Gratis
                </a>
            </div>
        </div>
    </div>

    <div class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16 text-gray-800">Kenapa Belajar di Sini?</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl mb-6 flex items-center justify-center text-blue-600 font-bold text-xl">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Interaktif</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Fitur <b>"Try It Yourself"</b> memungkinkan Anda menjalankan kode Python langsung di browser tanpa setup environment.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-green-100 rounded-xl mb-6 flex items-center justify-center text-green-600 font-bold text-xl">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Terstruktur</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Materi disusun rapi mulai dari sintaks dasar, percabangan, OOP, hingga pemrosesan data tingkat lanjut.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl mb-6 flex items-center justify-center text-purple-600 font-bold text-xl">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Progress Tracking</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem otomatis menyimpan progres belajar Anda. Dapatkan tanda centang hijau setiap kali menyelesaikan tantangan.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection