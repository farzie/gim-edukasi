@extends('layouts.app')

@section('title')
    <title>Kurikulum - Python Gampang</title>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <div class="text-center mb-16">
            <h2 class="text-sm font-bold text-blue-600 tracking-wider uppercase mb-3">Roadmap Belajar</h2>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                Kurikulum Python
            </h1>
            <p class="mt-4 max-w-2xl text-lg text-gray-500 mx-auto leading-relaxed">
                Disusun bertahap dari pemula hingga mahir. Pilih modul di bawah ini untuk memulai perjalanan coding Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($courses as $course)
                <a href="{{ route('courses.show', $course->slug) }}" 
                   class="group bg-white rounded-2xl p-8 border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-500 transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                    
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gray-50 rounded-full group-hover:bg-blue-50 transition-colors duration-300"></div>

                    <div class="relative z-10 flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <i class="fas {{ $course->icon ?? 'fa-book' }} text-2xl"></i>
                        </div>
                        
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-xs font-bold text-gray-500 border border-gray-200 uppercase tracking-wide">
                            Modul 0{{ $loop->iteration }}
                        </span>
                    </div>
                    
                    <div class="relative z-10 flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                            {{ $course->title }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            {{ Str::limit($course->description, 110) }}
                        </p>
                    </div>
                    
                    <div class="relative z-10 mt-8 pt-6 border-t border-gray-100 flex items-center text-blue-600 font-semibold text-sm group-hover:text-blue-700">
                        <span>Lihat Materi</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-gray-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                        <i class="fas fa-box-open text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada materi</h3>
                    <p class="mt-2 text-gray-500">Materi sedang disiapkan oleh instruktur.</p>
                </div>
            @endforelse
        </div>
        
    </div>
</div>
@endsection