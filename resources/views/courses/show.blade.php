@extends('layouts.app')

@section('title')
    <title>{{ $course->title }} - Materi Belajar</title>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    
    {{-- LOGIC PERHITUNGAN PROGRES (PERBAIKAN) --}}
    @php
        // Menggunakan filter untuk mengecek method isCompleted() pada setiap challenge
        $completedChallenges = $course->challenges->filter(function($challenge) {
            return $challenge->isCompleted();
        });

        $completedCount = $completedChallenges->count();
        $totalCount = $course->challenges->count();
        
        // Hindari pembagian dengan nol
        $percent = $totalCount > 0 ? ($completedCount / $totalCount) * 100 : 0;
    @endphp

    <div class="border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full">
                Modul
            </span>
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl tracking-tight">
                {{ $course->title }}
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 leading-relaxed">
                {{ $course->description }}
            </p>

            <div class="mt-8 max-w-sm mx-auto">
                <div class="flex justify-between text-xs font-medium text-gray-500 mb-1">
                    <span>Progres Modul</span>
                    <span>{{ $completedCount }} / {{ $totalCount }} Selesai</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-1.5">
                    <div class="bg-blue-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-4">
            
            @foreach($course->challenges as $challenge)
            <a href="{{ route('courses.lesson', ['slug' => $course->slug, 'challenge' => $challenge->id]) }}" 
               class="group relative block bg-white border border-gray-200 rounded-xl p-6 hover:border-blue-500 transition-all duration-300">
                
                <div class="flex items-start gap-5">
                    <div class="flex-shrink-0 mt-1">
                        {{-- Cek Status Per Item --}}
                        @if($challenge->isCompleted())
                            <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center border border-green-200">
                                <i class="fas fa-check text-sm"></i>
                            </div>
                        @else
                            <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center font-mono text-sm font-bold group-hover:bg-blue-600 group-hover:text-white transition-colors border border-gray-200">
                                {{ $loop->iteration }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                {{ $challenge->title }}
                            </h3>
                            <i class="fas fa-arrow-right text-gray-300 group-hover:text-blue-500 transform group-hover:translate-x-1 transition-all"></i>
                        </div>
                        
                        <p class="mt-2 text-gray-500 text-sm line-clamp-2 leading-relaxed">
                            {{ Str::limit(strip_tags($challenge->content), 120) }}
                        </p>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
    </div>
</div>
@endsection