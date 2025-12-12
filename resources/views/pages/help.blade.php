@extends('layouts.app')

@section('title')
    <title>Pusat Bantuan - PyGam</title>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen">
    
    <div class="bg-blue-600 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Bagaimana kami bisa membantu?</h1>
            <p class="text-blue-100 text-lg mb-8">Temukan jawaban untuk pertanyaan umum seputar belajar Python di sini.</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 py-16 -mt-8">
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fas fa-info-circle text-orange-500"></i> Pertanyaan Umum
            </h2>

            <div class="space-y-4">
                <details class="group [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between cursor-pointer p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                        <h3 class="font-medium text-gray-900">Apakah PyGam benar-benar gratis?</h3>
                        <span class="text-gray-400 transition group-open:-rotate-180">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </summary>
                    <div class="p-4 text-gray-600 leading-relaxed border-t border-gray-100 mt-2">
                        Ya, seluruh materi dasar Python di PyGam dapat diakses secara gratis. Kami percaya pendidikan pemrograman harus bisa diakses oleh siapa saja.
                    </div>
                </details>

                <details class="group [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between cursor-pointer p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                        <h3 class="font-medium text-gray-900">Apakah saya perlu menginstal Python di laptop?</h3>
                        <span class="text-gray-400 transition group-open:-rotate-180">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </summary>
                    <div class="p-4 text-gray-600 leading-relaxed border-t border-gray-100 mt-2">
                        Tidak perlu! PyGam menyediakan fitur <strong>Sandbox Cloud</strong>. Anda bisa menulis dan menjalankan kode Python langsung dari browser Anda, baik di laptop maupun HP.
                    </div>
                </details>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fas fa-cogs text-blue-500"></i> Masalah Teknis
            </h2>

            <div class="space-y-4">
                <details class="group [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between cursor-pointer p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                        <h3 class="font-medium text-gray-900">Kode saya tidak berjalan / Loading lama</h3>
                        <span class="text-gray-400 transition group-open:-rotate-180">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </summary>
                    <div class="p-4 text-gray-600 leading-relaxed border-t border-gray-100 mt-2">
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Pastikan koneksi internet Anda stabil.</li>
                            <li>Hindari kode yang melakukan <em>infinite loop</em> (perulangan tanpa henti).</li>
                        </ul>
                    </div>
                </details>
                
                <details class="group [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between cursor-pointer p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                        <h3 class="font-medium text-gray-900">Bagaimana cara reset progres belajar?</h3>
                        <span class="text-gray-400 transition group-open:-rotate-180">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </summary>
                    <div class="p-4 text-gray-600 leading-relaxed border-t border-gray-100 mt-2">
                        Saat ini fitur reset progres otomatis belum tersedia di dashboard. Silakan hubungi admin jika Anda ingin mengulang modul dari 0%.
                    </div>
                </details>
            </div>
        </div>

        <div class="text-center py-8">
            <p class="text-gray-500 mb-4">Masih belum menemukan jawaban?</p>
            <a href="mailto:farziexemail@gmail.com" class="inline-flex items-center gap-2 text-blue-600 font-bold hover:text-orange-500 transition">
                <i class="fas fa-envelope"></i> Hubungi Tim Support
            </a>
        </div>

    </div>
</div>
@endsection