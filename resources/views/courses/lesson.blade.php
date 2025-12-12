@extends('layouts.app')

@section('title')
    <title>{{ $challenge->title }} - Pembelajaran</title>
@endsection

@section('content')
<div class="bg-white min-h-screen">
    
    <div class="sticky top-0 z-20 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('courses.show', $challenge->course->slug) }}" class="text-gray-500 hover:text-gray-900 text-sm font-medium flex items-center gap-2 transition">
                <i class="fas fa-arrow-left"></i>
                <span class="hidden sm:inline">Daftar Materi</span>
            </a>
            
            <div class="text-sm font-medium text-gray-900">
                <span class="text-gray-400 mr-2 font-normal">Modul:</span> {{ $challenge->course->title }}
            </div>
            
            <div class="text-sm text-gray-400 font-mono">
                Part {{ $challenge->order }}
            </div>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
        
        <article class="prose prose-lg prose-slate max-w-none">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-8 tracking-tight leading-tight">
                {{ $challenge->title }}
            </h1>

            <div class="text-gray-600 leading-8">
                {!! $challenge->content !!}
            </div>
        </article>

        <div class="mt-16 pt-8 border-t border-gray-100">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                
                @if($prevChallenge)
                    <a href="{{ route('courses.lesson', ['slug' => $challenge->course->slug, 'challenge' => $prevChallenge->id]) }}" 
                       class="text-gray-500 hover:text-blue-600 font-medium flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-50 transition w-full sm:w-auto justify-center sm:justify-start">
                        <i class="fas fa-arrow-left"></i> Materi Sebelumnya
                    </a>
                @else
                    <div class="hidden sm:block"></div>
                @endif

                <div class="w-full sm:w-auto">
                    <a href="{{ route('courses.challenge', ['slug' => $challenge->course->slug, 'challenge' => $challenge->id]) }}" 
                       class="flex items-center justify-center gap-3 w-full sm:w-auto bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700">
                        <span>Coba Kodingan</span>
                        <i class="fas fa-terminal text-sm"></i>
                    </a>
                    <p class="text-center text-xs text-gray-400 mt-2">
                        Masuk ke Sandbox Editor
                    </p>
                </div>

                @if($nextChallenge)
                    <a href="{{ route('courses.lesson', ['slug' => $challenge->course->slug, 'challenge' => $nextChallenge->id]) }}" 
                       class="text-gray-500 hover:text-blue-600 font-medium flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-50 transition w-full sm:w-auto justify-center sm:justify-end sm:hidden">
                        Materi Selanjutnya <i class="fas fa-arrow-right"></i>
                    </a>
                @else
                    <div class="hidden sm:block"></div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection