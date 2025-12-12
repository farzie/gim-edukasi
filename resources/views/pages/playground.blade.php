<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playground - Python Gampang</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/dracula.min.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .CodeMirror { height: 100%; font-size: 14px; background-color: #0f172a; color: #e2e8f0; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
    </style>
</head>
<body class="bg-slate-950 text-slate-200 flex flex-col h-screen overflow-hidden">

    <header class="bg-slate-900 border-b border-slate-800 h-14 flex items-center justify-between px-4 shrink-0">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-slate-400 hover:text-white transition">
                <i class="fas fa-home"></i>
            </a>
            <div class="h-4 w-px bg-slate-700"></div>
            <span class="font-bold text-blue-500 tracking-wider text-sm uppercase">Python Playground</span>
        </div>
        
        <div class="flex items-center gap-3">
             <button id="reset-code" class="text-xs text-slate-400 hover:text-white transition px-3 py-1.5 rounded hover:bg-slate-800">
                <i class="fas fa-trash-alt mr-1"></i> Bersihkan
            </button>
            <a href="{{ route('courses.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold px-4 py-2 rounded-md transition">
                Kembali ke Materi
            </a>
        </div>
    </header>

    <div class="flex-1 flex flex-col md:flex-row h-full">
        
        <div class="flex-1 flex flex-col h-full border-r border-slate-800 relative">
            <div class="h-8 bg-slate-900 border-b border-slate-800 flex items-center px-4 justify-between shrink-0">
                <span class="text-xs text-slate-500">main.py</span>
                <span class="text-[10px] text-slate-600">Auto-saved</span>
            </div>
            <div class="flex-1 relative">
                <textarea id="code-editor"># Selamat datang di Playground!
# Tempat bebas untuk mencoba kode Python apapun.

nama = "Programmer"
print(f"Halo, {nama}!")
print("Silakan bereksperimen di sini...")

for i in range(3):
    print(f"Hitungan ke-{i+1}")
</textarea>
            </div>
        </div>

        <div class="w-full md:w-2/5 flex flex-col bg-black h-1/2 md:h-full shrink-0">
            <div class="h-8 bg-slate-900 border-b border-slate-800 flex items-center justify-between px-4 shrink-0">
                <span class="text-xs font-bold text-slate-400 uppercase"><i class="fas fa-terminal mr-2"></i>Terminal</span>
                <button id="run-button" class="text-green-400 hover:text-white text-xs font-bold transition flex items-center gap-1">
                    <i class="fas fa-play"></i> RUN
                </button>
            </div>
            <div class="flex-1 p-4 font-mono text-sm overflow-y-auto text-slate-300 relative bg-[#0f172a]">
                <div id="loading" class="hidden text-blue-400 animate-pulse mb-2">> Menjalankan script...</div>
                <pre id="output-result" class="whitespace-pre-wrap"></pre>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/edit/closebrackets.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
                lineNumbers: true, mode: "python", theme: "dracula",
                indentUnit: 4, lineWrapping: true, autoCloseBrackets: true
            });

            const outputElement = document.getElementById('output-result');
            const runButton = document.getElementById('run-button');
            const loading = document.getElementById('loading');

            runButton.addEventListener('click', function() {
                const code = editor.getValue();
                outputElement.textContent = '';
                loading.classList.remove('hidden');
                runButton.disabled = true;
                runButton.classList.add('opacity-50');

                // Menggunakan route run-python yang sama dengan sandbox materi
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
                    outputElement.textContent = data.output || "Tidak ada output.";
                })
                .catch(err => {
                    outputElement.textContent = 'Error: ' + err;
                })
                .finally(() => {
                    loading.classList.add('hidden');
                    runButton.disabled = false;
                    runButton.classList.remove('opacity-50');
                });
            });

            document.getElementById('reset-code').addEventListener('click', () => {
                if(confirm('Hapus semua kode?')) editor.setValue('');
            });
        });
    </script>
</body>
</html>