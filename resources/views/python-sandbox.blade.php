<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- Menggunakan 'vh' untuk memastikan mobile mengambil tinggi layar penuh --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian Python: Hello World 5x</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/theme/dracula.min.css">
    
    <style>
        /* Memastikan CodeMirror mengisi tinggi kontainernya */
        .CodeMirror {
            /* Penting: Set tinggi 100% untuk mengisi kontainer parent */
            height: 100%; 
            font-size: 14px;
            background-color: #282c34; 
        }

        /* Memastikan output-area menggunakan font monospace */
        #output-result {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            white-space: pre-wrap; /* Memastikan output membungkus teks */
        }

        html, body {
            height: 100%;
        }

        /* Styling untuk pesan Lulus/Gagal */
        .validation-message {
            font-weight: bold;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>
{{-- PERUBAHAN UTAMA: Ubah latar belakang body menjadi sangat gelap (misalnya bg-gray-900) dan teks default menjadi putih (misalnya text-gray-100) --}}
<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">
    
    <header class="bg-gray-800 shadow-lg"> {{-- Header menjadi abu-abu gelap --}}
        <div class="container mx-auto p-4 sm:p-6 lg:p-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white text-center"> {{-- Teks header menjadi putih --}}
                Ujian Python Dasar 🐍
            </h1>
        </div>
    </header>

    <div class="container mx-auto p-4 sm:p-6 lg:p-8 flex-1 flex flex-col">
        
        <div class="bg-gray-800 p-4 rounded-lg shadow-lg mb-4 border border-indigo-700"> {{-- Kartu informasi menjadi abu-abu gelap --}}
            <h2 class="text-xl font-semibold text-indigo-400">Tugas: Hello World Berulang</h2> {{-- Ubah warna h2 menjadi lebih terang --}}
            <p class="mt-2 text-gray-300">Tulis kode Python yang menampilkan teks <b>"Hello, World!"</b> sebanyak <span class="font-bold">5 kali</span> menggunakan <span class="font-bold">struktur perulangan</span> (`for` atau `while`).</p>
            <p class="text-sm text-gray-400 mt-1">Output yang diharapkan: 5 baris teks "Hello, World!"</p>
        </div>
        
        <div id="editor-container" class="flex flex-col gap-4 lg:flex-row lg:gap-6 flex-1">
            
            {{-- Area kode CodeMirror sudah gelap (dracula theme) --}}
            <div class="code-area w-full lg:w-1/2 bg-gray-900 rounded-lg shadow-xl overflow-hidden flex flex-col flex-1">
                <h3 class="text-lg font-semibold p-3 bg-gray-700 text-green-500 flex justify-between items-center">
                    <span><i class="fas fa-code mr-2"></i> Code Editor</span>
                </h3>
                <textarea id="code-editor" class="w-full h-full"># Tulis kode perulangan Anda di sini
for i in range(5):
    # ganti baris ini
    pass</textarea>
            </div>
            
            {{-- Area output juga sudah gelap --}}
            <div class="output-area w-full lg:w-1/2 rounded-lg shadow-xl bg-gray-800 text-green-300 flex flex-col overflow-hidden flex-1">
                <h3 class="text-lg font-semibold p-3 bg-gray-700 text-yellow-500 flex justify-between items-center">
                    <span><i class="fas fa-terminal mr-2"></i> Terminal Output</span>
                    <span id="validation-icon" class="text-xl"></span>
                </h3>
                {{-- Area untuk pesan validasi dan output --}}
                <div id="output-result-container" class="flex-grow flex flex-col overflow-hidden">
                    <pre id="output-result" class="p-4 flex-grow overflow-y-auto text-sm">Output Anda akan muncul di sini setelah klik 'Jalankan Kode'.</pre>
                    <div id="validation-message" class="validation-message text-white p-2"></div>
                </div>
            </div>
            
        </div>
        
        <div class="mt-6 text-center lg:text-left">
            <button id="run-button" 
                    {{-- Ubah warna tombol menjadi lebih gelap/kontras --}}
                    class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-full shadow-lg hover:bg-indigo-700 transition duration-300 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed transform">
                Jalankan & Periksa Kode
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/mode/python/python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.13/addon/edit/closebrackets.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi CodeMirror dengan fitur autoCloseBrackets
            const editor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
                lineNumbers: true,
                mode: "python",
                theme: "dracula",
                indentUnit: 4,
                lineWrapping: true,
                // Solusi Mobile: Menggunakan add-on CodeMirror bawaan
                autoCloseBrackets: true 
            });

            const outputElement = document.getElementById('output-result');
            const runButton = document.getElementById('run-button');
            const validationMessage = document.getElementById('validation-message');
            const validationIcon = document.getElementById('validation-icon');
            
            // Output yang Diharapkan
            const EXPECTED_OUTPUT = Array(5).fill("Hello, World!").join('\n') + '\n';
            
            // Fungsi untuk membersihkan output (menghapus baris kosong/spasi berlebih)
            function cleanOutput(output) {
                // Menghapus spasi di akhir baris dan baris kosong di awal/akhir
                return output.trim().split('\n').map(line => line.trim()).join('\n') + '\n';
            }

            // Fungsi Validasi Ujian
            function validateOutput(rawOutput) {
                const cleanedOutput = cleanOutput(rawOutput);
                const expectedCleaned = cleanOutput(EXPECTED_OUTPUT);
                
                return cleanedOutput === expectedCleaned;
            }

            function displayResult(isSuccess, outputText) {
                if (isSuccess) {
                    validationMessage.textContent = "Selamat! Tugas Selesai!";
                    validationMessage.className = "validation-message bg-green-600 text-white p-2";
                    validationIcon.innerHTML = '<i class="fas fa-check-circle text-green-500"></i>';
                } else {
                    validationMessage.textContent = "Belum berhasil. Cek kembali perulangan dan output Anda.";
                    validationMessage.className = "validation-message bg-red-600 text-white p-2";
                    validationIcon.innerHTML = '<i class="fas fa-times-circle text-red-500"></i>';
                }
                outputElement.textContent = outputText; // Tampilkan output mentah dari server
            }

            runButton.addEventListener('click', function() {
                const code = editor.getValue();
                
                outputElement.textContent = '⌛ Sedang menjalankan kode...';
                validationMessage.textContent = '';
                validationMessage.className = "validation-message text-white p-2";
                validationIcon.innerHTML = '';
                runButton.disabled = true;

                // Menggunakan `fetch` dengan route Blade
                fetch('{{ route('python.run') }}', { // Pastikan route ini benar
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ code: code })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => { throw new Error(`Server Error (${response.status}): ${text}`) });
                    }
                    return response.json();
                })
                .then(data => {
                    const rawOutput = data.output || "";
                    const success = validateOutput(rawOutput);
                    displayResult(success, rawOutput);
                })
                .catch(error => {
                    console.error('Error:', error);
                    displayResult(false, '❌ Terjadi kesalahan! ' + error.message);
                })
                .finally(() => {
                    runButton.disabled = false;
                });
            });
        });
    </script>
</body>
</html>