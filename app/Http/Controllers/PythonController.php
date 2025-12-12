<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use App\Models\UserProgress;
use Exception;

class PythonController extends Controller
{
    // Menampilkan view utama
    public function index()
    {
        return view('python-sandbox');
    }

    public function run(Request $request)
    {
        // 1. Batasi Waktu Eksekusi PHP (Fail-Safe untuk Windows)
        // Batasi waktu eksekusi skrip PHP menjadi 10 detik. Ini akan menghentikan proses shell_exec jika terlalu lama.
        set_time_limit(10); 
        
        $timeStart = time();

        try {
            // --- 2. Validasi Input (Keamanan Dasar) ---
            $request->validate([
                'code' => 'required|string|max:5000', // Batas 5KB
            ]);
        } catch (ValidationException $e) {
            return response()->json(['output' => 'Kesalahan Validasi: Kode terlalu panjang atau tidak valid.'], 422);
        }

        $code = $request->input('code');

        // --- 3. Deteksi Kata Kunci Berbahaya (Layer Keamanan Tambahan) ---
        $forbiddenKeywords = ['import os', 'import subprocess', 'import socket', 'os.', 'subprocess.', 'socket.', 'shutil.', 'sys.exit', 'open('];
        
        foreach ($forbiddenKeywords as $keyword) {
            if (stripos($code, $keyword) !== false) {
                return response()->json(['output' => "🛑 Eksekusi diblokir: Kata kunci '$keyword' terlarang."], 403);
            }
        }

        $tempFileName = 'script_' . time() . '_' . uniqid() . '.py';
        $tempFilePath = storage_path('app/temp/' . $tempFileName);
        
        // Path Absolut Host Server (Penting untuk kompatibilitas Docker dan Ngrok)
        $absolutePath = $tempFilePath; 

        // --- 4. Penanganan File dan Direktori ---
        try {
            // Pastikan folder temp ada
            if (!File::isDirectory(dirname($tempFilePath))) {
                // Pastikan izin 0777 untuk kompatibilitas Windows/XAMPP
                File::makeDirectory(dirname($tempFilePath), 0777, true, true);
            }
            
            // Simpan kode ke file sementara di HOST
            File::put($tempFilePath, $code);

        } catch (Exception $e) {
            // Error ini menunjukkan masalah izin/penulisan file
            return response()->json([
                'output' => "🚨 Error Izin File: Gagal menyimpan skrip sementara. Cek izin tulis di folder 'storage/app/temp/'."
            ], 500);
        }

        // --- 5. Perintah Docker (Kunci Kompatibilitas Ngrok & Windows) ---
        
        // --rm: Hapus container setelah selesai
        // -m 128m: Batas memori 128MB
        // --network none: Matikan akses jaringan (KRUSIAL UNTUK KEAMANAN)
        // --read-only: File system container read-only
        $dockerCommand = "docker run --rm -m 128m --network none --read-only ";
        
        // Mounting file skrip. escapeshellarg penting untuk path Windows.
        $dockerCommand .= "-v " . escapeshellarg($absolutePath) . ":/usr/src/app/script.py ";
        
        // Gabungkan command. HILANGKAN 'timeout' Windows
        // 2>&1 menggabungkan stdout dan stderr
        $finalCommand = $dockerCommand . "laravel-python-executor 2>&1";

        // --- 6. Eksekusi Command ---
        $output = shell_exec($finalCommand);
        $timeEnd = time();
        $executionTime = $timeEnd - $timeStart;

        // --- 7. Pembersihan ---
        File::delete($tempFilePath);

        // --- 8. Penanganan Output dan Timeout ---
        
        // Cek apakah waktu eksekusi mendekati batas set_time_limit (misal, > 8 detik dari batas 10)
        if ($executionTime >= 8) { 
            return response()->json([
                'output' => "⌛ Eksekusi dibatalkan: Waktu eksekusi melebihi batas 10 detik."
            ]);
        }
        
        if ($output === null || ($output === '' && $executionTime < 1)) { 
             // Jika output benar-benar kosong dan prosesnya cepat, kemungkinan masalah Docker Engine
            return response()->json([
                'output' => "Output Kosong."
            ]);
        }

        return response()->json([
            'output' => trim($output)
        ]);
    }

    public function markComplete(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'challenge_id' => 'required|exists:challenges,id'
        ]);

        // 2. Cek apakah user login
        if (!auth()->check()) {
            return response()->json(['message' => 'User not logged in'], 401);
        }

        // 3. Simpan atau Update Progress
        // updateOrCreate akan mengecek:
        // Jika data user_id & challenge_id sudah ada -> update kolom is_completed
        // Jika belum ada -> buat baris baru
        UserProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'challenge_id' => $request->challenge_id
            ],
            [
                'is_completed' => true
            ]
        );

        return response()->json(['success' => true, 'message' => 'Progress saved!']);
    }
}