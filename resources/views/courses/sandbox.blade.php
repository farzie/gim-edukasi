<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        
        /* Mobile Specific Helpers */
        .mobile-hidden { display: none; }
        @media (min-width: 768px) {
            .mobile-hidden { display: flex !important; }
            .mobile-only { display: none !important; }
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-200 flex flex-col h-screen overflow-hidden pb-14 md:pb-0">
    
    <header class="bg-slate-900 border-b border-slate-800 h-14 md:h-16 flex items-center justify-between px-4 shrink-0 z-50 shadow-md">
        <div class="flex items-center gap-3">
            <a href="{{ route('courses.show', $challenge->course->slug) }}" 
               class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white transition-all"
               title="Kembali">
                <i class="fas fa-chevron-left text-xs md:text-sm"></i>
            </a>
            <div class="flex flex-col overflow-hidden">
                <span class="text-[10px] uppercase tracking-wider font-bold text-blue-500 truncate">
                    {{ $challenge->course->title }}
                </span>
                <h1 class="text-sm md:text-base font-bold text-white flex items-center gap-2 truncate">
                    <span class="truncate">{{ $challenge->title }}</span>
                </h1>
            </div>
        </div>
        <button id="run-button-mobile" class="md:hidden bg-green-600 text-white text-xs font-bold px-3 py-1.5 rounded flex items-center gap-1 active:scale-95 transition">
            <i class="fas fa-play"></i> RUN
        </button>
    </header>

    <div class="flex flex-1 overflow-hidden relative w-full h-full">
        
        <div id="panel-instruction" class="w-full md:w-1/3 max-w-md bg-slate-900 border-r border-slate-800 flex-col mobile-hidden md:flex absolute md:relative inset-0 z-10 md:z-auto">
            <div class="flex border-b border-slate-800 bg-slate-900 shrink-0">
                <div class="px-6 py-3 text-sm font-medium text-blue-400 border-b-2 border-blue-500 bg-slate-800/50 w-full md:w-auto">
                    <i class="fas fa-book-open mr-2"></i> Instruksi
                </div>
            </div>
            <div class="p-6 overflow-y-auto flex-1 custom-scrollbar pb-20 md:pb-6">
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

        <div class="flex-1 flex flex-col md:flex-row h-full relative w-full">
            
            <div id="panel-code" class="flex-1 flex flex-col h-full border-r border-slate-800 relative w-full absolute md:relative inset-0 z-20 md:z-auto bg-slate-900">
                <div class="h-10 bg-slate-900 border-b border-slate-800 flex justify-between items-center px-4 shrink-0">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <i class="fab fa-python text-blue-400"></i>
                        <span>main.py</span>
                    </div>
                    <button id="reset-code" class="text-xs text-slate-500 hover:text-white transition flex items-center gap-1">
                        <i class="fas fa-undo-alt"></i> <span class="hidden sm:inline">Reset</span>
                    </button>
                </div>
                <div class="flex-1 relative bg-slate-900">
                    <textarea id="code-editor"></textarea>
                </div>
            </div>

            <div id="panel-console" class="w-full md:w-2/5 flex flex-col bg-black h-full shrink-0 border-t md:border-t-0 md:border-l border-slate-800 mobile-hidden md:flex absolute md:relative inset-0 z-30 md:z-auto">
                <div class="h-10 bg-slate-900 border-b border-slate-800 flex justify-between items-center px-4 shrink-0">
                    <span class="text-xs font-bold text-slate-400 uppercase">
                        <i class="fas fa-terminal mr-2"></i> Console
                    </span>
                    <button id="run-button-desktop" class="hidden md:flex bg-green-600 hover:bg-green-500 text-white text-xs font-bold px-4 py-1.5 rounded-md shadow-lg shadow-green-900/20 transition-all items-center gap-2 transform active:scale-95">
                        <i class="fas fa-play text-[10px]"></i> JALANKAN
                    </button>
                </div>
                <div class="flex-1 p-4 font-mono text-sm overflow-y-auto relative bg-[#0f172a] pb-20 md:pb-4">
                    <div id="loading-indicator" class="hidden text-blue-400 animate-pulse mb-2">
                        > Sedang menjalankan kode...
                    </div>
                    <pre id="output-result" class="text-slate-300 whitespace-pre-wrap text-xs md:text-sm"></pre>
                    
                    <div id="success-overlay" class="hidden absolute inset-0 z-50 bg-slate-900/95 backdrop-blur-sm flex flex-col items-center justify-center text-center p-6 animate-fade-in">
                        <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mb-4 ring-4 ring-green-500/10">
                            <i class="fas fa-check text-3xl text-green-500"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Luar Biasa!</h3>
                        <p class="text-slate-400 mb-8 max-w-xs mx-auto">Jawaban Anda benar.</p>
                        @if($nextChallenge)
                        <a href="{{ route('courses.lesson', ['slug' => $challenge->course->slug, 'challenge' => $nextChallenge->id]) }}" 
                           class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-full font-bold shadow-lg shadow-blue-500/30">
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

    <nav class="md:hidden fixed bottom-0 left-0 w-full bg-slate-900 border-t border-slate-800 flex justify-around items-center h-14 z-50">
        <button onclick="switchMobileTab('instruction')" id="nav-instruction" class="flex flex-col items-center justify-center w-full h-full text-slate-500 hover:text-blue-400 transition">
            <i class="fas fa-book mb-1 text-sm"></i>
            <span class="text-[10px]">Soal</span>
        </button>
        <button onclick="switchMobileTab('code')" id="nav-code" class="flex flex-col items-center justify-center w-full h-full text-blue-400 border-t-2 border-blue-500 transition">
            <i class="fas fa-code mb-1 text-sm"></i>
            <span class="text-[10px]">Kode</span>
        </button>
        <button onclick="switchMobileTab('console')" id="nav-console" class="flex flex-col items-center justify-center w-full h-full text-slate-500 hover:text-green-400 transition relative">
            <i class="fas fa-terminal mb-1 text-sm"></i>
            <span class="text-[10px]">Hasil</span>
            <span id="console-badge" class="hidden absolute top-2 right-8 w-2 h-2 bg-green-500 rounded-full"></span>
        </button>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/edit/closebrackets.min.js"></script>

    <script>
        // --- 1. SETUP EDITOR ---
        const EXPECTED_OUTPUT = {!! json_encode($challenge->expected_output) !!};
        const INITIAL_CODE = {!! json_encode($challenge->initial_code) !!};
        const CHALLENGE_ID = {{ $challenge->id }};

        const editor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
            lineNumbers: true, mode: "python", theme: "dracula",
            indentUnit: 4, lineWrapping: true, autoCloseBrackets: true
        });
        
        editor.setValue(INITIAL_CODE);

        // --- 2. MOBILE TAB LOGIC ---
        function switchMobileTab(tabName) {
            // Hanya aktif di layar kecil (width < 768px)
            if (window.innerWidth >= 768) return;

            // Reset semua nav button
            document.querySelectorAll('nav button').forEach(btn => {
                btn.classList.remove('text-blue-400', 'border-t-2', 'border-blue-500', 'text-white');
                btn.classList.add('text-slate-500');
            });

            // Sembunyikan semua panel
            ['instruction', 'code', 'console'].forEach(p => {
                document.getElementById('panel-' + p).style.display = 'none';
            });

            // Aktifkan tab yang dipilih
            const activePanel = document.getElementById('panel-' + tabName);
            const activeBtn = document.getElementById('nav-' + tabName);
            
            activePanel.style.display = 'flex';
            
            // Styling tombol aktif
            activeBtn.classList.remove('text-slate-500');
            activeBtn.classList.add('text-blue-400', 'border-t-2', 'border-blue-500');

            // Khusus CodeMirror: Perlu refresh saat tab kode muncul agar tidak blank
            if (tabName === 'code') {
                setTimeout(() => { editor.refresh(); }, 10);
            }
        }

        // Initialize mobile view (default ke tab Code)
        if (window.innerWidth < 768) {
            switchMobileTab('code');
        }

        // Handle resize window (kembalikan layout desktop jika diputar/diperbesar)
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                // Reset styling inline agar CSS Flexbox desktop bekerja
                document.getElementById('panel-instruction').style.display = '';
                document.getElementById('panel-code').style.display = '';
                document.getElementById('panel-console').style.display = '';
            } else {
                // Jika resize ke mobile, paksa salah satu tab aktif
                switchMobileTab('code');
            }
        });

        // --- 3. RUN LOGIC ---
        const outputElement = document.getElementById('output-result');
        const loadingIndicator = document.getElementById('loading-indicator');
        const successOverlay = document.getElementById('success-overlay');

        function runCode() {
            const code = editor.getValue();
            
            // UI Updates
            outputElement.textContent = '';
            loadingIndicator.classList.remove('hidden');
            successOverlay.classList.add('hidden');
            
            // Otomatis pindah ke tab console jika di mobile
            switchMobileTab('console');

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

                // Simple Comparison Logic
                const simpleClean = (str) => (!str ? "" : str.trim().replace(/\r\n/g, '\n').replace(/\r/g, '\n').replace(/'/g, '"'));
                
                if (simpleClean(rawOutput) === simpleClean(EXPECTED_OUTPUT)) {
                    outputElement.innerHTML += '\n\n<span class="text-green-500 font-bold text-xs">[SYSTEM]: Jawaban Benar!</span>';
                    
                    // Simpan progress
                    fetch('{{ route('challenge.complete') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ challenge_id: CHALLENGE_ID })
                    });

                    setTimeout(() => { successOverlay.classList.remove('hidden'); }, 800);
                } else {
                    outputElement.innerHTML += '\n\n<span class="text-red-400 font-bold text-xs">[SYSTEM]: Output belum sesuai.</span>';
                }
            })
            .catch(err => {
                loadingIndicator.classList.add('hidden');
                outputElement.textContent = 'Error: ' + err;
            });
        }

        // Attach Event Listeners
        document.getElementById('run-button-desktop').addEventListener('click', runCode);
        document.getElementById('run-button-mobile').addEventListener('click', runCode);

        document.getElementById('reset-code').addEventListener('click', () => {
            if(confirm('Reset kode ke awal?')) {
                editor.setValue(INITIAL_CODE);
            }
        });
    </script>
</body>
</html>