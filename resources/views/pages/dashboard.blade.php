@extends('layouts.app')

@section('title')
    <title>Dashboard - PyGam</title>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Halo, <span class="text-blue-600">{{ $user->name }}!</span> 👋
                </h1>
                <p class="text-gray-500 mt-1">Siap melanjutkan petualangan coding hari ini?</p>
            </div>
            
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-book-reader text-blue-500"></i> Progres Belajar Saya
                </h2>

                @forelse($courses as $course)
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:border-blue-300 transition-colors">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 border border-gray-200">
                                <i class="fas {{ $course->icon ?? 'fa-code' }} text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $course->completed_tasks }} dari {{ $course->challenges_count }} materi selesai</p>
                            </div>
                        </div>
                        
                        @if($course->progress_percent >= 100)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                <i class="fas fa-check mr-1"></i> Selesai
                            </span>
                        @else
                            <a href="{{ route('courses.show', $course->slug) }}" class="text-sm font-semibold text-blue-600 hover:text-orange-500 transition-colors">
                                Lanjutkan <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        @endif
                    </div>

                    <div class="w-full bg-gray-100 rounded-full h-2.5 mb-1 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2.5 rounded-full transition-all duration-1000 ease-out" 
                             style="width: {{ $course->progress_percent }}%"></div>
                    </div>
                    <div class="flex justify-end">
                        <span class="text-xs font-bold text-gray-600">{{ $course->progress_percent }}%</span>
                    </div>
                </div>
                @empty
                <div class="bg-white p-8 rounded-xl border border-dashed border-gray-300 text-center">
                    <p class="text-gray-500 mb-4">Anda belum memiliki progres belajar.</p>
                    <a href="{{ route('courses.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Mulai Kursus Pertama
                    </a>
                </div>
                @endforelse

            </div>

            <div class="space-y-6">
                
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-slate-900 h-24 relative">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500 rounded-full mix-blend-overlay filter blur-xl opacity-20"></div>
                </div>
                
                <div class="px-6 pb-6 relative">
                    <div class="w-20 h-20 bg-white p-1 rounded-full absolute -top-10 left-6 shadow-sm">
                        <div class="w-full h-full bg-orange-500 rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-inner">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </div>
                    
                    <div class="pt-14">
                        <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Status Belajar</span>
                            </div>

                            @if($totalChallengesGlobal > 0 && $totalCompletedGlobal == $totalChallengesGlobal)
                                <div class="bg-green-100 border border-green-200 rounded-lg p-3 text-center">
                                    <span class="block text-green-600 font-bold text-lg">
                                        <i class="fas fa-certificate mr-1"></i> LULUS
                                    </span>
                                    <span class="text-xs text-green-700">Semua materi selesai!</span>
                                </div>
                            @else
                                <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 flex justify-between items-center">
                                    <div>
                                        <span class="block text-blue-700 font-bold">Pelajar Aktif</span>
                                        <span class="text-xs text-blue-500">
                                            {{ $totalCompletedGlobal }} dari {{ $totalChallengesGlobal }} Selesai
                                        </span>
                                    </div>
                                    <div class="relative w-10 h-10 flex items-center justify-center">
                                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                            <path class="text-blue-200" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4" />
                                            <path class="text-blue-600" stroke-dasharray="{{ ($totalChallengesGlobal > 0) ? ($totalCompletedGlobal / $totalChallengesGlobal) * 100 : 0 }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4" />
                                        </svg>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="mt-4 text-center">
                                <p class="text-xs text-gray-400">Bergabung sejak: {{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>

    </div>
</div>
@endsection