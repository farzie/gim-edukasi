<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $challenge->title }} - Sandbox</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/dracula.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .CodeMirror { height: 100%; font-size: 14px; background-color: #1e293b; color: #e2e8f0; }
        .cm-s-dracula.CodeMirror { background-color: #1e293b !important; } 
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body class="bg-slate-950 text-slate-200 flex flex-col h-screen overflow-hidden">
    
    <header class="bg-slate-900 border-b border-slate-800 h-16 flex items-center justify-between px-4 sm:px-6 shrink-0 z-50 shadow-md">
        <div class="flex items-center gap-4">
            <a href="{{ route('courses.show', $challenge->course->slug) }}" 
               class="w-10 h-10 rounded-full bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-slate-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-200 group"
               title="Kembali ke Daftar Materi">
                <i class="fas fa-chevron-left group-hover:-translate-x-0.5 transition-transform"></i>
            </a>
            <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-wider font-bold text-blue-500">
                    {{ $challenge->course->title }}
                </span>
                <h1 class="text-base font-bold text-white leading-tight flex items-center gap-2">
                    {{ $challenge->title }}
                    <span class="px-2 py-0.5 rounded text-[10px] bg-slate-800 text-slate-400 border border-slate-700 font-normal">
                        Soal #{{ $challenge->order }}
                    </span>
                </h1>
            </div>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        <div class="w-1/3 max-w-md bg-slate-900 border-r border-slate-800 flex flex-col hidden md:flex">
            <div class="flex border-b border-slate-800 bg-slate-900">
                <button class="px-6 py-3 text-sm font-medium text-blue-400 border-b-2 border-blue-500 bg-slate-800/50">
                    <i class="fas fa-book-open mr-2"></i> Instruksi
                </button>
            </div>
            <div class="p-6 overflow-y-auto flex-1 custom-scrollbar">
                <div class="prose prose-invert prose-sm max-w-none text-slate-300 leading-relaxed">
                    <p>{{ $challenge->description }}</p>
                </div>
                <div class="mt-8">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">Target Output:</h3>
                    <div class="bg-black/50 rounded-lg border border-slate-800 p-4 font-mono text-sm text-green-400 shadow-inner">
                        <pre class="whitespace-pre-wrap">{{ $challenge->expected_output }}</pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col md:flex-row h-full relative">
            <div class="flex-1 flex flex-col h-full border-r border-slate-800 relative group">
                <div class="h-10 bg-slate-900 border-b border-slate-800 flex justify-between items-center px-4 shrink-0">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <i class="fab fa-python text-blue-400"></i>
                        <span>main.py</span>
                    </div>
                    <button id="reset-code" class="text-xs text-slate-500 hover:text-white transition flex items-center gap-1">
                        <i class="fas fa-undo-alt"></i> Reset Kode
                    </button>
                </div>
                <div class="flex-1 relative bg-slate-900">
                    <textarea id="code-editor"></textarea>
                </div>
            </div>

            <div class="w-full md:w-2/5 flex flex-col bg-black h-1/2 md:h-full shrink-0 border-t md:border-t-0 md:border-l border-slate-800">
                <div class="h-10 bg-slate-900 border-b border-slate-800 flex justify-between items-center px-4 shrink-0">
                    <span class="text-xs font-bold text-slate-400 uppercase">
                        <i class="fas fa-terminal mr-2"></i> Console
                    </span>
                    <button id="run-button" class="bg-green-600 hover:bg-green-500 text-white text-xs font-bold px-4 py-1.5 rounded-md shadow-lg shadow-green-900/20 transition-all flex items-center gap-2 transform active:scale-95">
                        <i class="fas fa-play text-[10px]"></i> JALANKAN
                    </button>
                </div>
                <div class="flex-1 p-4 font-mono text-sm overflow-y-auto relative bg-[#0f172a]">
                    <div id="loading-indicator" class="hidden text-blue-400 animate-pulse">
                        > Sedang menjalankan kode...
                    </div>
                    <pre id="output-result" class="text-slate-300 whitespace-pre-wrap"></pre>
                    
                    <div id="success-overlay" class="hidden absolute inset-0 z-10 bg-slate-900/95 backdrop-blur-sm flex flex-col items-center justify-center text-center p-6 animate-fade-in">
                        <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mb-4 ring-4 ring-green-500/10">
                            <i class="fas fa-check text-3xl text-green-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Luar Biasa!</h3>
                        <p class="text-slate-400 mb-8 max-w-xs mx-auto">Jawaban Anda benar.</p>
                        @if($nextChallenge)
                        <a href="{{ route('courses.lesson', ['slug' => $challenge->course->slug, 'challenge' => $nextChallenge->id]) }}" 
                           class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-full font-bold">
                            Lanjut Materi &rarr;
                        </a>
                        @else
                        <a href="{{ route('courses.show', $challenge->course->slug) }}" class="px-8 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-full font-bold transition">
                            Kembali ke Menu
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/edit/closebrackets.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Data Dinamis dari Backend (DIPERBAIKI DENGAN JSON_ENCODE)
            const EXPECTED_OUTPUT = {!! json_encode($challenge->expected_output) !!};
            const INITIAL_CODE = {!! json_encode($challenge->initial_code) !!};
            const CHALLENGE_ID = {{ $challenge->id }};

            const editor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
                lineNumbers: true, mode: "python", theme: "dracula",
                indentUnit: 4, lineWrapping: true, autoCloseBrackets: true
            });
            
            // Set Initial Code
            editor.setValue(INITIAL_CODE);
            setTimeout(() => { editor.refresh(); }, 1);

            const outputElement = document.getElementById('output-result');
            const runButton = document.getElementById('run-button');
            const loadingIndicator = document.getElementById('loading-indicator');
            const successOverlay = document.getElementById('success-overlay');
            
            // Fungsi Pembersih String yang Lebih Kuat
            function cleanString(str) {
                if (!str) return "";
                return str
                    .trim() // Hapus spasi di awal/akhir
                    .replace(/\r\n/g, '\n') // Standarisasi newline windows
                    .replace(/\r/g, '\n') // Standarisasi newline mac
                    .replace(/\s+$/gm, '') // Hapus spasi di ujung setiap baris
                    .replace(/'/g, '"'); // Menyamakan jenis tanda kutip (opsional, hati-hati jika teks mengandung kutip)
            }
            
            // Khusus untuk struktur data (Dict/List), normalisasi tanda kutip sangat membantu
            // Kita gunakan versi yang lebih simpel untuk perbandingan umum:
            function simpleClean(str) {
                if (!str) return "";
                return str.trim().replace(/\r\n/g, '\n').replace(/\r/g, '\n');
            }

            function saveProgress() {
                fetch('{{ route('challenge.complete') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ challenge_id: CHALLENGE_ID })
                }).catch(console.error);
            }

            runButton.addEventListener('click', function() {
                const code = editor.getValue();
                outputElement.textContent = '';
                loadingIndicator.classList.remove('hidden');
                successOverlay.classList.add('hidden');
                runButton.disabled = true;
                runButton.classList.add('opacity-50', 'cursor-not-allowed');

                fetch('{{ route('python.run') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ code: code })
                })
                .then(res => res.json())
                .then(data => {
                    const rawOutput = data.output || "";
                    loadingIndicator.classList.add('hidden');
                    outputElement.textContent = rawOutput;

                    // Perbandingan
                    // Kita gunakan replace tanda kutip single ke double untuk standarisasi output Python Dict
                    // Python output: {'a': 1} (single) -> diganti jadi {"a": 1}
                    // Expected output dari DB (PHP json_encode): "{\"a\": 1}" -> sudah double
                    
                    const userClean = simpleClean(rawOutput).replace(/'/g, '"');
                    const targetClean = simpleClean(EXPECTED_OUTPUT).replace(/'/g, '"');

                    if (userClean === targetClean) {
                        outputElement.innerHTML += '\n\n<span class="text-green-500 font-bold">[SYSTEM]: Jawaban Benar!</span>';
                        saveProgress();
                        setTimeout(() => {
                            successOverlay.classList.remove('hidden');
                        }, 800);
                    } else {
                        outputElement.innerHTML += '\n\n<span class="text-red-400 font-bold">[SYSTEM]: Output belum sesuai target.</span>';
                    }
                })
                .catch(err => {
                    loadingIndicator.classList.add('hidden');
                    outputElement.textContent = 'Error: ' + err;
                })
                .finally(() => {
                    runButton.disabled = false;
                    runButton.classList.remove('opacity-50', 'cursor-not-allowed');
                });
            });

            document.getElementById('reset-code').addEventListener('click', () => {
                if(confirm('Reset kode ke awal?')) {
                    editor.setValue(INITIAL_CODE);
                }
            });
        });
    </script>
</body>
</html>