<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Challenge;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama (Opsional, hati-hati jika production)
        // Challenge::truncate(); 
        // Course::truncate();

        // --- COURSE 1: PENDAHULUAN ---
        $c1 = Course::firstOrCreate([
            'slug' => 'pendahuluan-python'
        ], [
            'title' => 'Pendahuluan Python',
            'description' => 'Pelajari dasar-dasar cara kerja dari Python seperti cara mencetak teks dan berhitung.',
            'icon' => 'fa-brands fa-python'
        ]);

        // MATERI 1: Menampilkan Teks
        Challenge::create([
            'course_id' => $c1->id,
            'title' => 'Menampilkan Teks',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Menampilkan Output ke Layar</h3>
                <p class="mb-4 text-gray-600 leading-relaxed">
                    Dalam pemrograman Python, hal paling dasar yang harus diketahui adalah bagaimana cara "berbicara" dengan komputer. 
                    Kita menggunakan fungsi bawaan bernama <code>print()</code>.
                </p>
                
                <div class="bg-gray-100 border-l-4 border-blue-500 p-4 mb-6 rounded-r">
                    <p class="font-mono text-sm text-gray-800">print("Halo, Dunia!")</p>
                </div>

                <p class="mb-4 text-gray-600 leading-relaxed">
                    Teks yang ingin ditampilkan harus diapit oleh tanda kutip ganda (<code>"..."</code>) atau tanda kutip tunggal (<code>\'...\'</code>).
                    Jika Anda lupa tanda kutip saat mencetak teks, Python akan bingung dan menghasilkan error.
                </p>
            ',
            'description' => 'Tugas: Gunakan fungsi print() untuk menampilkan teks "Hello Python" (tanpa tanda kutip di output).',
            'initial_code' => "# Ketik kodemu di bawah ini\n",
            'expected_output' => "Hello Python",
            'order' => 1
        ]);

        // MATERI 2: Perhitungan Sederhana
        Challenge::create([
            'course_id' => $c1->id,
            'title' => 'Perhitungan Sederhana',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Python sebagai Kalkulator</h3>
                <p class="mb-4 text-gray-600 leading-relaxed">
                    Python sangat handal dalam matematika. Anda bisa melakukan perhitungan langsung di dalam fungsi <code>print()</code> tanpa menggunakan tanda kutip.
                </p>
                
                <h4 class="font-bold text-gray-800 mb-2">Operator Dasar:</h4>
                <ul class="list-disc pl-5 mb-6 text-gray-600 space-y-1">
                    <li><code>+</code> : Penjumlahan</li>
                    <li><code>-</code> : Pengurangan</li>
                    <li><code>*</code> : Perkalian</li>
                    <li><code>/</code> : Pembagian</li>
                </ul>

                <div class="bg-gray-100 p-4 mb-6 rounded border border-gray-200">
                    <code class="block text-sm mb-2">print(5 + 3) &nbsp;&nbsp;# Output: 8</code>
                    <code class="block text-sm">print(10 * 2) &nbsp;# Output: 20</code>
                </div>
            ',
            'description' => 'Tugas: Cetak hasil perkalian dari 25 dikali 4.',
            'initial_code' => "# Hitung 25 dikali 4\nprint(...)",
            'expected_output' => "100",
            'order' => 2
        ]);

        // --- COURSE 2: VARIABEL & TIPE DATA ---
        $c2 = Course::firstOrCreate([
            'slug' => 'variabel-tipe-data'
        ], [
            'title' => 'Variabel & Tipe Data',
            'description' => 'Memahami pondasi Python: Variabel, Tipe Data Numerik, String, Boolean, dan Operator.',
            'icon' => 'fa-solid fa-cube'
        ]);

        // MATERI 1: Variabel Dalam Python
        Challenge::create([
            'course_id' => $c2->id,
            'title' => 'Variabel Dalam Python',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Apa itu Variabel?</h3>
                <p class="mb-4 text-gray-600 leading-relaxed">
                    Variabel adalah nama yang diberikan untuk lokasi penyimpanan data dalam memori. Bayangkan variabel sebagai <strong>wadah</strong> untuk menyimpan nilai yang dapat dimanipulasi sepanjang program.
                </p>
                <p class="mb-4 text-gray-600">
                    Di Python, Anda <strong>tidak perlu</strong> mendeklarasikan tipe data secara eksplisit. Python secara otomatis tahu tipe datanya berdasarkan nilai yang Anda berikan.
                </p>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <h4 class="font-bold text-blue-700">Aturan Penamaan Variabel:</h4>
                    <ul class="list-disc pl-5 text-sm text-blue-800 space-y-1 mt-2">
                        <li>Harus diawali huruf (a-z, A-Z) atau garis bawah (<code>_</code>).</li>
                        <li><strong>Tidak boleh</strong> diawali angka.</li>
                        <li>Hanya boleh huruf, angka, dan garis bawah.</li>
                        <li>Bersifat <em>Case-sensitive</em> (<code>nama</code> dan <code>Nama</code> itu beda).</li>
                        <li>Tidak boleh menggunakan kata kunci Python (contoh: <code>if</code>, <code>for</code>, <code>print</code>).</li>
                    </ul>
                </div>

                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm">
                    nama = "Budi" <span class="text-green-600"># Benar</span><br>
                    1nama = "Budi" <span class="text-red-500"># Salah (diawali angka)</span>
                </div>
            ',
            'description' => 'Tugas: Buatlah variabel bernama `kampus` dan isi dengan teks "Politeknik". Lalu cetak variabel tersebut.',
            'initial_code' => "# Buat variabel kampus di sini\n\n# Lalu print variabel tersebut\n",
            'expected_output' => "Politeknik",
            'order' => 1
        ]);

        // MATERI 2: Tipe Data
        Challenge::create([
            'course_id' => $c2->id,
            'title' => 'Tipe Data',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Python itu Dinamis</h3>
                <p class="mb-4 text-gray-600 leading-relaxed">
                    Python adalah bahasa pemrograman yang dinamis. Artinya, tipe data suatu variabel ditentukan saat nilai diberikan ke variabel tersebut.
                </p>
                
                <h4 class="font-bold text-gray-800 mb-3">Tipe Data Fundamental:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white border border-gray-200 p-4 rounded-lg shadow-sm">
                        <strong class="text-blue-600">Numerik</strong>
                        <p class="text-sm text-gray-500 mt-1">Angka (bulat, desimal, kompleks).</p>
                    </div>
                    <div class="bg-white border border-gray-200 p-4 rounded-lg shadow-sm">
                        <strong class="text-green-600">String</strong>
                        <p class="text-sm text-gray-500 mt-1">Teks, diapit tanda kutip.</p>
                    </div>
                    <div class="bg-white border border-gray-200 p-4 rounded-lg shadow-sm">
                        <strong class="text-purple-600">Boolean</strong>
                        <p class="text-sm text-gray-500 mt-1">Nilai kebenaran (True/False).</p>
                    </div>
                    <div class="bg-white border border-gray-200 p-4 rounded-lg shadow-sm">
                        <strong class="text-gray-600">NoneType</strong>
                        <p class="text-sm text-gray-500 mt-1">Merepresentasikan ketiadaan nilai.</p>
                    </div>
                </div>
            ',
            'description' => 'Tugas: Buat variabel `nilai` dengan isi angka 100. Cetak variabel tersebut.',
            'initial_code' => "nilai = 100\nprint(nilai)",
            'expected_output' => "100",
            'order' => 2
        ]);

        // MATERI 3: Tipe Numerik
        Challenge::create([
            'course_id' => $c2->id,
            'title' => 'Tipe Numerik',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Angka dalam Python</h3>
                <p class="mb-4 text-gray-600">Dua tipe numerik yang paling umum digunakan adalah:</p>
                
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-l-4 border-l-4 border-indigo-500">
                        <h4 class="font-bold text-indigo-700">1. Integer (int)</h4>
                        <p class="text-sm text-gray-600">Bilangan bulat tanpa koma/desimal.</p>
                        <code class="bg-gray-200 px-2 py-1 rounded text-xs mt-2 inline-block">x = 10</code>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-l-4 border-l-4 border-pink-500">
                        <h4 class="font-bold text-pink-700">2. Float (float)</h4>
                        <p class="text-sm text-gray-600">Bilangan pecahan dengan komponen desimal.</p>
                        <code class="bg-gray-200 px-2 py-1 rounded text-xs mt-2 inline-block">y = 3.14</code>
                    </div>
                </div>
            ',
            'description' => 'Tugas: Buat variabel `ipk` dengan nilai desimal 3.75 (gunakan titik, bukan koma). Lalu print.',
            'initial_code' => "# Buat variabel ipk = 3.75\n\nprint(...)",
            'expected_output' => "3.75",
            'order' => 3
        ]);

        // MATERI 4: Tipe String
        Challenge::create([
            'course_id' => $c2->id,
            'title' => 'Tipe String',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Teks & Karakter</h3>
                <p class="mb-4 text-gray-600">
                    Tipe string (<code>str</code>) digunakan untuk teks. String harus diapit oleh tanda kutip.
                </p>
                
                <div class="bg-gray-100 p-4 rounded border border-gray-200 mb-4">
                    <p class="mb-2"><strong>Kutip Tunggal:</strong> <code>\'Halo\'</code></p>
                    <p><strong>Kutip Ganda:</strong> <code>"Halo Dunia"</code></p>
                </div>
                
                <p class="text-sm text-gray-500">Tips: Jika teks mengandung kutip tunggal (misal: Jum\'at), gunakan kutip ganda di luarnya.</p>
            ',
            'description' => 'Tugas: Buat variabel `salam` berisi teks "Selamat Pagi" (gunakan kutip ganda).',
            'initial_code' => "salam = ...\nprint(salam)",
            'expected_output' => "Selamat Pagi",
            'order' => 4
        ]);

        // MATERI 5: Tipe Boolean
        Challenge::create([
            'course_id' => $c2->id,
            'title' => 'Tipe Boolean',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Benar atau Salah?</h3>
                <p class="mb-4 text-gray-600">
                    Tipe Boolean (<code>bool</code>) hanya memiliki dua kemungkinan nilai. Perhatikan huruf besar di awal kata!
                </p>
                
                <div class="flex gap-4 justify-center my-6">
                    <div class="px-6 py-3 bg-green-100 text-green-800 rounded-full font-bold shadow-sm">True</div>
                    <div class="px-6 py-3 bg-red-100 text-red-800 rounded-full font-bold shadow-sm">False</div>
                </div>
                
                <p class="text-gray-600">Tipe ini sangat penting nanti saat kita belajar logika percabangan (IF/ELSE).</p>
            ',
            'description' => 'Tugas: Buat variabel `status_aktif` dengan nilai True. Pastikan huruf T kapital.',
            'initial_code' => "status_aktif = ...\nprint(status_aktif)",
            'expected_output' => "True",
            'order' => 5
        ]);

        // MATERI 6: Tipe NoneType
        Challenge::create([
            'course_id' => $c2->id,
            'title' => 'Tipe NoneType',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Nilai Kosong</h3>
                <p class="mb-4 text-gray-600">
                    <code>NoneType</code> adalah tipe khusus yang merepresentasikan <strong>ketiadaan nilai</strong> atau nol (bukan angka 0, tapi "kosong").
                </p>
                <p class="mb-4 text-gray-600">
                    Kata kuncinya adalah <code>None</code> (Perhatikan huruf N besar).
                </p>
                <div class="bg-yellow-50 p-4 border-l-4 border-yellow-400 text-sm text-yellow-700">
                    Berguna saat kita ingin membuat variabel tapi belum tahu mau diisi apa (Placeholder).
                </div>
            ',
            'description' => 'Tugas: Buat variabel `data_kosong` dan isi dengan None.',
            'initial_code' => "data_kosong = None\nprint(data_kosong)",
            'expected_output' => "None",
            'order' => 6
        ]);

        // MATERI 7: Operator
        Challenge::create([
            'course_id' => $c2->id,
            'title' => 'Operator',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Alat Operasi Data</h3>
                <p class="mb-4 text-gray-600">Operator adalah simbol untuk melakukan operasi pada data.</p>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-600 mb-6">
                        <thead class="bg-gray-100 text-gray-900 font-bold uppercase">
                            <tr>
                                <th class="px-4 py-2">Kategori</th>
                                <th class="px-4 py-2">Operator</th>
                                <th class="px-4 py-2">Fungsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-2 font-medium">Aritmatika</td>
                                <td class="px-4 py-2 font-mono text-blue-600">+, -, *, /, %, **</td>
                                <td class="px-4 py-2">Matematika dasar (tambah, kurang, kali, bagi, sisa, pangkat)</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-medium">Assignment</td>
                                <td class="px-4 py-2 font-mono text-blue-600">=, +=, -=</td>
                                <td class="px-4 py-2">Memberi nilai ke variabel</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-medium">Pembanding</td>
                                <td class="px-4 py-2 font-mono text-blue-600">==, !=, >, <</td>
                                <td class="px-4 py-2">Membandingkan (Hasilnya True/False)</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-medium">Logika</td>
                                <td class="px-4 py-2 font-mono text-blue-600">and, or, not</td>
                                <td class="px-4 py-2">Logika Boolean</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-medium">String</td>
                                <td class="px-4 py-2 font-mono text-blue-600">+</td>
                                <td class="px-4 py-2">Menggabungkan teks</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            ',
            'description' => 'Tugas: Gunakan operator aritmatika. Hitung hasil dari (10 ditambah 5) dikali 2.',
            'initial_code' => "# Hitung (10 + 5) * 2\nhasil = ...\nprint(hasil)",
            'expected_output' => "30",
            'order' => 7
        ]);

        // --- COURSE 3: FLOW CONTROL ---
        $c3 = Course::firstOrCreate([
            'slug' => 'flow-control'
        ], [
            'title' => 'Flow Control',
            'description' => 'Mengatur alur logika program dengan Percabangan (If/Else) dan Perulangan (Loops).',
            'icon' => 'fa-solid fa-code-branch'
        ]);

        // MATERI 1: Flow Control Dalam Python
        Challenge::create([
            'course_id' => $c3->id,
            'title' => 'Apa itu Flow Control?',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Mengatur Alur Program</h3>
                <p class="mb-4 text-gray-600 leading-relaxed">
                    <strong>Flow control</strong> atau kontrol alur adalah cara mengatur urutan eksekusi instruksi dalam program.
                    Tanpa ini, program hanya akan berjalan lurus dari baris pertama sampai terakhir.
                </p>
                <p class="mb-4 text-gray-600">
                    Dengan Flow Control, program menjadi cerdas:
                </p>
                <ul class="list-disc pl-5 mb-6 text-gray-600 space-y-1">
                    <li><strong>Membuat Keputusan:</strong> "Jika hujan, bawa payung."</li>
                    <li><strong>Mengulang Tugas:</strong> "Cetak halaman ini 10 kali."</li>
                    <li><strong>Melompat:</strong> "Lewati langkah ini jika data kosong."</li>
                </ul>
                
                <div class="bg-blue-50 p-4 border-l-4 border-blue-500 rounded">
                    <p class="text-sm text-blue-800">
                        <strong>Konsep Dasar:</strong> Program tidak lagi statis, tapi dinamis dan interaktif sesuai kondisi yang terjadi.
                    </p>
                </div>
            ',
            'description' => 'Tugas: Mari pemanasan. Buat variabel `hujan` dengan nilai True. Lalu gunakan print() untuk mencetak variabel tersebut.',
            'initial_code' => "hujan = True\nprint(hujan)",
            'expected_output' => "True",
            'order' => 1
        ]);

        // MATERI 2: Percabangan Kondisional (If, Else)
        Challenge::create([
            'course_id' => $c3->id,
            'title' => 'Percabangan (If, Else)',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Membuat Keputusan</h3>
                <p class="mb-4 text-gray-600">
                    Percabangan memungkinkan program menjalankan kode yang berbeda berdasarkan kondisi tertentu.
                </p>
                
                
                <div class="space-y-4 mb-6">
                    <div class="bg-gray-100 p-3 rounded">
                        <code class="text-blue-600 font-bold">if</code>
                        <span class="text-gray-600">: Mengeksekusi kode jika kondisi <strong>True</strong>.</span>
                    </div>
                    <div class="bg-gray-100 p-3 rounded">
                        <code class="text-blue-600 font-bold">else</code>
                        <span class="text-gray-600">: Mengeksekusi kode jika kondisi <strong>False</strong>.</span>
                    </div>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <h4 class="font-bold text-yellow-800 uppercase text-xs tracking-wider mb-1">PENTING: INDENTASI</h4>
                    <p class="text-sm text-yellow-700">
                        Python menggunakan <strong>Spasi (Indentasi)</strong> untuk menandai blok kode. Baris setelah `if` atau `else` 
                        <strong>harus menjorok ke dalam</strong> (biasanya 4 spasi atau 1 tab).
                    </p>
                </div>
            ',
            'description' => 'Tugas: Diberikan variabel `umur = 15`. Buat logika if/else: Jika umur >= 17 cetak "Dewasa", jika tidak cetak "Belum Dewasa".',
            'initial_code' => "umur = 15\n\nif umur >= 17:\n    print(\"Dewasa\")\nelse:\n    print(\"...\")",
            'expected_output' => "Belum Dewasa",
            'order' => 2
        ]);

        // MATERI 3: Percabangan Lanjutan (Elif)
        Challenge::create([
            'course_id' => $c3->id,
            'title' => 'Percabangan Lanjutan (Elif)',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Banyak Kondisi (Else If)</h3>
                <p class="mb-4 text-gray-600">
                    Bagaimana jika pilihannya lebih dari dua? Kita gunakan <code>elif</code> (singkatan dari Else If).
                </p>
                
                <div class="bg-gray-900 text-gray-200 p-4 rounded-lg font-mono text-sm mb-6">
                    nilai = 75<br><br>
                    <span class="text-purple-400">if</span> nilai >= 90:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;print("A")<br>
                    <span class="text-purple-400">elif</span> nilai >= 70:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;print("B") <span class="text-gray-500"># Ini yang akan dijalankan</span><br>
                    <span class="text-purple-400">else</span>:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;print("C")
                </div>

                <p class="text-gray-600 text-sm">
                    Program akan mengecek dari atas ke bawah. Jika satu kondisi terpenuhi, sisanya diabaikan.
                </p>
            ',
            'description' => 'Tugas: Tentukan grade lampu lalu lintas. Warna "Kuning". Jika Merah cetak "Berhenti", elif Kuning cetak "Siap-siap", else "Jalan".',
            'initial_code' => "warna = \"Kuning\"\n\nif warna == \"Merah\":\n    print(\"Berhenti\")\nelif ...:\n    print(\"Siap-siap\")\nelse:\n    print(\"Jalan\")",
            'expected_output' => "Siap-siap",
            'order' => 3
        ]);

        // MATERI 4: Perulangan For
        Challenge::create([
            'course_id' => $c3->id,
            'title' => 'Perulangan For',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Mengulang Sequence</h3>
                <p class="mb-4 text-gray-600">
                    Perulangan <code>for</code> ideal digunakan ketika kita sudah tahu berapa kali kita ingin mengulang, atau ingin memproses setiap item dalam sebuah koleksi (seperti list atau range).
                </p>
                
                <h4 class="font-bold text-gray-800 mt-6 mb-2">Fungsi range()</h4>
                <p class="mb-4 text-gray-600">Sering digunakan bersama for untuk menghasilkan deret angka.</p>
                <div class="bg-gray-100 p-3 rounded font-mono text-sm text-gray-700">
                    for i in range(3):<br>
                    &nbsp;&nbsp;print(i)<br>
                    # Output: 0, 1, 2
                </div>
            ',
            'description' => 'Tugas: Gunakan loop `for` dan `range(3)` untuk mencetak angka 0 sampai 2.',
            'initial_code' => "# Loop range(3)\nfor i in ...:\n    print(i)",
            'expected_output' => "0\n1\n2",
            'order' => 4
        ]);

        // MATERI 5: Perulangan While
        Challenge::create([
            'course_id' => $c3->id,
            'title' => 'Perulangan While',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Mengulang Berdasarkan Kondisi</h3>
                <p class="mb-4 text-gray-600">
                    Perulangan <code>while</code> akan terus berjalan selama kondisinya bernilai <strong>True</strong>.
                </p>

                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <h4 class="font-bold text-red-700 text-xs uppercase tracking-wider">Bahaya: Infinite Loop</h4>
                    <p class="text-sm text-red-600 mt-1">
                        Pastikan Anda membuat mekanisme untuk menghentikan loop (membuat kondisi menjadi False). 
                        Jika tidak, program akan berjalan selamanya sampai komputer hang.
                    </p>
                </div>

                <div class="bg-gray-900 text-gray-200 p-4 rounded-lg font-mono text-sm">
                    counter = 3<br>
                    <span class="text-purple-400">while</span> counter > 0:<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;print(counter)<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;counter -= 1 <span class="text-gray-500"># Penting! Kurangi nilai agar loop berhenti</span>
                </div>
            ',
            'description' => 'Tugas: Buat while loop yang mencetak angka 1, lalu berhenti. (Set i = 1, while i > 0: print i, lalu i -= 1)',
            'initial_code' => "i = 1\nwhile i > 0:\n    print(i)\n    i -= 1",
            'expected_output' => "1",
            'order' => 5
        ]);

        // MATERI 6: Break
        Challenge::create([
            'course_id' => $c3->id,
            'title' => 'Statement Break',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Hentikan Paksa</h3>
                <p class="mb-4 text-gray-600">
                    <code>break</code> digunakan untuk menghentikan perulangan secara paksa dan segera keluar dari blok loop tersebut, meskipun kondisi aslinya masih True.
                </p>

                <div class="bg-gray-100 p-4 rounded border border-gray-200 mb-4">
                    <p class="text-sm font-mono text-gray-800">
                        for i in range(10):<br>
                        &nbsp;&nbsp;if i == 5:<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-red-600 font-bold">break</span> <span class="text-gray-500"># Stop saat angka 5</span><br>
                        &nbsp;&nbsp;print(i)
                    </p>
                </div>
            ',
            'description' => 'Tugas: Loop `range(5)`. Jika `i` sama dengan 2, lakukan break. Cetak `i` di setiap iterasi.',
            'initial_code' => "for i in range(5):\n    if i == 2:\n        ...\n    print(i)",
            'expected_output' => "0\n1",
            'order' => 6
        ]);

        // MATERI 7: Continue
        Challenge::create([
            'course_id' => $c3->id,
            'title' => 'Statement Continue',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Lompati Langkah Ini</h3>
                <p class="mb-4 text-gray-600">
                    <code>continue</code> digunakan untuk melewatkan sisa kode dalam iterasi saat ini, dan langsung melompat ke iterasi berikutnya.
                </p>
                <p class="mb-4 text-gray-600">
                    Bedanya dengan break: <strong>Break</strong> mematikan loop sepenuhnya, <strong>Continue</strong> hanya melewati satu putaran.
                </p>

                <div class="bg-gray-100 p-4 rounded border border-gray-200">
                    <p class="text-sm font-mono text-gray-800">
                        for i in range(3):<br>
                        &nbsp;&nbsp;if i == 1:<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-blue-600 font-bold">continue</span> <span class="text-gray-500"># Angka 1 tidak akan dicetak</span><br>
                        &nbsp;&nbsp;print(i)
                    </p>
                    <p class="text-xs text-gray-500 mt-2">Output: 0, 2</p>
                </div>
            ',
            'description' => 'Tugas: Loop `range(3)`. Jika `i` == 0, lakukan continue. Print `i` untuk angka lainnya.',
            'initial_code' => "for i in range(3):\n    if i == 0:\n        continue\n    print(i)",
            'expected_output' => "1\n2",
            'order' => 7
        ]);

        // --- COURSE 4: STRUKTUR DATA ---
        $c4 = Course::firstOrCreate([
            'slug' => 'struktur-data-python'
        ], [
            'title' => 'Struktur Data Python',
            'description' => 'Mengelola data kompleks dengan List, Tuple, Set, dan Dictionary untuk efisiensi program.',
            'icon' => 'fa-solid fa-layer-group'
        ]);

        // MATERI 1: Pengantar & List
        Challenge::create([
            'course_id' => $c4->id,
            'title' => 'List (Daftar)',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Menyimpan Banyak Data</h3>
                <p class="mb-4 text-gray-600 leading-relaxed">
                    Struktur data adalah cara mengatur dan menyimpan data agar efisien. Struktur data paling dasar di Python adalah <strong>List</strong>.
                </p>
                
                
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <h4 class="font-bold text-blue-800">Karakteristik List:</h4>
                    <ul class="list-disc pl-5 text-sm text-blue-700 mt-2 space-y-1">
                        <li><strong>Terurut:</strong> Data disimpan sesuai urutan masuk.</li>
                        <li><strong>Mutable:</strong> Isinya bisa diubah, ditambah, atau dihapus.</li>
                        <li><strong>Indeks:</strong> Diakses menggunakan nomor urut (mulai dari 0).</li>
                    </ul>
                </div>

                <h4 class="font-bold text-gray-800 mb-2">Sintaks List</h4>
                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm mb-4">
                    buah = ["Apel", "Jeruk", "Mangga"]<br>
                    print(buah[0]) <span class="text-gray-500"># Output: Apel</span>
                </div>
            ',
            'description' => 'Tugas: Buat list bernama `buah` berisi "Apel", "Jeruk", "Mangga". Lalu print elemen kedua ("Jeruk").',
            'initial_code' => "buah = [\"Apel\", \"Jeruk\", \"Mangga\"]\n# Print elemen indeks ke-1\nprint(...)",
            'expected_output' => "Jeruk",
            'order' => 1
        ]);

        // MATERI 2: Manipulasi List
        Challenge::create([
            'course_id' => $c4->id,
            'title' => 'Manipulasi List',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Mengubah Isi List</h3>
                <p class="mb-4 text-gray-600">
                    Karena List bersifat <em>Mutable</em>, kita bisa memanipulasinya menggunakan berbagai metode bawaan (Method).
                </p>

                <div class="overflow-x-auto mb-6">
                    <table class="min-w-full text-sm text-left text-gray-600 border rounded">
                        <thead class="bg-gray-100 text-gray-900 font-bold">
                            <tr>
                                <th class="px-4 py-2">Method</th>
                                <th class="px-4 py-2">Fungsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-2 font-mono text-blue-600">append(x)</td>
                                <td class="px-4 py-2">Menambah <code>x</code> ke akhir list.</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-mono text-blue-600">remove(x)</td>
                                <td class="px-4 py-2">Menghapus item <code>x</code> pertama yang ditemukan.</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-mono text-blue-600">pop(i)</td>
                                <td class="px-4 py-2">Menghapus & mengambil item di posisi <code>i</code>.</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-mono text-blue-600">sort()</td>
                                <td class="px-4 py-2">Mengurutkan isi list.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm">
                    angka = [1, 5, 3]<br>
                    angka.append(9)  <span class="text-gray-500"># [1, 5, 3, 9]</span><br>
                    angka.sort()     <span class="text-gray-500"># [1, 3, 5, 9]</span>
                </div>
            ',
            'description' => 'Tugas: List `data = [10, 20]`. Gunakan `.append(30)` untuk menambah angka 30. Lalu print list tersebut.',
            'initial_code' => "data = [10, 20]\n# Tambahkan 30\n\n# Print data\n",
            'expected_output' => "[10, 20, 30]",
            'order' => 2
        ]);

        // MATERI 3: Tuple
        Challenge::create([
            'course_id' => $c4->id,
            'title' => 'Tuple',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">List yang "Terkunci"</h3>
                <p class="mb-4 text-gray-600">
                    <strong>Tuple</strong> sangat mirip dengan List, bedanya adalah Tuple bersifat <strong>Immutable</strong> (Tidak bisa diubah setelah dibuat).
                </p>
                <p class="mb-4 text-gray-600">
                    Tuple menggunakan tanda kurung biasa <code>()</code>.
                </p>
                

                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <p class="text-sm text-red-700">
                        <strong>Peringatan:</strong> Anda tidak bisa menggunakan <code>append()</code> atau mengubah nilai indeks pada Tuple. Jika dicoba, akan error.
                    </p>
                </div>

                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm">
                    koordinat = (10, 20)<br>
                    print(koordinat[0]) <span class="text-gray-500"># Boleh: 10</span><br>
                    <span class="text-red-500 line-through">koordinat[0] = 50</span> <span class="text-red-500"># Error!</span>
                </div>
            ',
            'description' => 'Tugas: Buat tuple `lokasi = (100, 200)`. Cetak elemen indeks ke-1.',
            'initial_code' => "lokasi = (100, 200)\nprint(...)",
            'expected_output' => "200",
            'order' => 3
        ]);

        // MATERI 4: Set
        Challenge::create([
            'course_id' => $c4->id,
            'title' => 'Set (Himpunan)',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Data Unik Tanpa Urutan</h3>
                <p class="mb-4 text-gray-600">
                    <strong>Set</strong> adalah koleksi data yang tidak terurut dan <strong>tidak mengizinkan duplikasi</strong>.
                    Set menggunakan kurung kurawal <code>{}</code>.
                </p>
                

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <p class="text-sm text-yellow-800">
                        Set sangat berguna untuk menghapus data ganda atau melakukan operasi matematika himpunan (Gabungan, Irisan).
                    </p>
                </div>

                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm mb-4">
                    # Data ganda otomatis dihapus<br>
                    angka = {1, 2, 2, 3, 3, 3}<br>
                    print(angka) <span class="text-gray-500"># Output: {1, 2, 3}</span>
                </div>
            ',
            'description' => 'Tugas: Buat set `unik = {1, 1, 2, 2, 3}`. Print panjang set menggunakan fungsi `len(unik)`.',
            'initial_code' => "unik = {1, 1, 2, 2, 3}\n# Berapa jumlah item setelah duplikat hilang?\nprint(...)",
            'expected_output' => "3",
            'order' => 4
        ]);

        // MATERI 5: Dictionary
        Challenge::create([
            'course_id' => $c4->id,
            'title' => 'Dictionary',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Kamus Data (Key-Value)</h3>
                <p class="mb-4 text-gray-600">
                    <strong>Dictionary</strong> menyimpan data berpasangan: <strong>Kunci (Key)</strong> dan <strong>Nilai (Value)</strong>.
                    Ini seperti kamus sungguhan (Kata = Arti), atau buku telepon (Nama = Nomor).
                </p>
                

                <h4 class="font-bold text-gray-800 mb-2">Sintaks</h4>
                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm mb-4">
                    siswa = {<br>
                    &nbsp;&nbsp;"nama": "Budi",<br>
                    &nbsp;&nbsp;"umur": 17<br>
                    }<br><br>
                    # Mengakses data pakai Key, bukan indeks angka<br>
                    print(siswa["nama"]) <span class="text-gray-500"># Output: Budi</span>
                </div>
            ',
            'description' => 'Tugas: Buat dictionary `mobil = {"merk": "Toyota", "tahun": 2020}`. Cetak value dari key "merk".',
            'initial_code' => "mobil = {\"merk\": \"Toyota\", \"tahun\": 2020}\n# Print merk mobil\nprint(...)",
            'expected_output' => "Toyota",
            'order' => 5
        ]);

        // MATERI 6: Metode Dictionary
        Challenge::create([
            'course_id' => $c4->id,
            'title' => 'Metode Dictionary',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Mengelola Dictionary</h3>
                <p class="mb-4 text-gray-600">
                    Dictionary bersifat mutable. Kita bisa menambah data baru, mengubah nilai, atau melihat semua kuncinya.
                </p>

                <ul class="list-disc pl-5 mb-6 text-gray-600 space-y-2">
                    <li><code>dict["baru"] = "nilai"</code> : Menambah data baru.</li>
                    <li><code>keys()</code> : Melihat semua kunci.</li>
                    <li><code>values()</code> : Melihat semua nilai.</li>
                    <li><code>update()</code> : Menggabungkan dictionary lain.</li>
                </ul>

                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm">
                    data = {"a": 1}<br>
                    data["b"] = 2  <span class="text-gray-500"># Menambah key "b"</span><br>
                    print(data)    <span class="text-gray-500"># {"a": 1, "b": 2}</span>
                </div>
            ',
            'description' => 'Tugas: Diberikan `buku = {"judul": "Python"}`. Tambahkan key "penulis" dengan value "Guido". Print dictionary buku.',
            'initial_code' => "buku = {\"judul\": \"Python\"}\n# Tambahkan key penulis\n\nprint(buku)",
            'expected_output' => "{'judul': 'Python', 'penulis': 'Guido'}",
            'order' => 6
        ]);

        // MATERI 7: Latihan Studi Kasus
        Challenge::create([
            'course_id' => $c4->id,
            'title' => 'Latihan: Data Pelanggan',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Studi Kasus: Mengelola Pelanggan</h3>
                <p class="mb-4 text-gray-600">
                    Mari kita gabungkan pengetahuan List dan Dictionary untuk mensimulasikan database pelanggan sederhana.
                </p>
                <p class="mb-4 text-gray-600">
                    Bayangkan kita punya daftar pelanggan, dimana setiap pelanggan memiliki detail informasi (Nama & ID).
                </p>

                <div class="bg-blue-50 p-4 rounded border border-blue-100">
                    <p class="font-bold text-blue-800 mb-2">Instruksi:</p>
                    <ol class="list-decimal pl-5 text-sm text-blue-700 space-y-1">
                        <li>Buat list kosong bernama <code>pelanggan</code>.</li>
                        <li>Tambahkan dictionary <code>{"nama": "Ali", "id": 1}</code> ke dalam list.</li>
                        <li>Tambahkan dictionary <code>{"nama": "Budi", "id": 2}</code> ke dalam list.</li>
                        <li>Print list pelanggan tersebut.</li>
                    </ol>
                </div>
            ',
            'description' => 'Tugas: Ikuti instruksi di materi. Buat list berisi 2 data pelanggan (dict) dan print list-nya.',
            'initial_code' => "# 1. List kosong\npelanggan = []\n\n# 2. Append Ali\n\n# 3. Append Budi\n\n# 4. Print\n",
            'expected_output' => "[{'nama': 'Ali', 'id': 1}, {'nama': 'Budi', 'id': 2}]",
            'order' => 7
        ]);

        // --- COURSE 5: FUNGSI PYTHON ---
        $c5 = Course::firstOrCreate([
            'slug' => 'fungsi-python'
        ], [
            'title' => 'Fungsi Python',
            'description' => 'Mempelajari modularitas kode dengan Fungsi, Parameter, Return Value, dan Built-in Functions.',
            'icon' => 'fa-solid fa-gears'
        ]);

        // MATERI 1: Definisi Fungsi
        Challenge::create([
            'course_id' => $c5->id,
            'title' => 'Mendefinisikan Fungsi',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Apa itu Fungsi?</h3>
                <p class="mb-4 text-gray-600 leading-relaxed">
                    Fungsi adalah blok kode terorganisir yang dapat digunakan kembali (reusable). Dengan fungsi, kita memecah program besar menjadi bagian-bagian kecil agar mudah diatur dan dibaca.
                </p>

                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm mb-6">
                    <span class="text-blue-600 font-bold">def</span> nama_fungsi():<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-gray-500"># Blok kode di sini</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;print("Halo")
                </div>

                <ul class="list-disc pl-5 text-gray-600 space-y-1">
                    <li><strong>def</strong>: Kata kunci untuk membuat fungsi.</li>
                    <li><strong>Indentasi</strong>: Wajib menjorok ke dalam (tab/spasi) untuk isi fungsi.</li>
                    <li><strong>return</strong>: (Opsional) Mengembalikan nilai hasil proses.</li>
                </ul>
            ',
            'description' => 'Tugas: Definisikan fungsi sederhana bernama `sapa` yang mencetak teks "Halo Python". Jangan lupa panggil fungsinya.',
            'initial_code' => "# Definisikan fungsi sapa\ndef sapa():\n    ...\n\n# Panggil fungsi\nsapa()",
            'expected_output' => "Halo Python",
            'order' => 1
        ]);

        // MATERI 2: Parameter dan Argumen
        Challenge::create([
            'course_id' => $c5->id,
            'title' => 'Parameter dan Argumen',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Mengirim Data ke Fungsi</h3>
                <p class="mb-4 text-gray-600">
                    Fungsi bisa menerima data agar lebih dinamis. Data ini disimpan dalam variabel yang disebut <strong>Parameter</strong>.
                </p>
                
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                    <ul class="text-sm text-blue-800">
                        <li><strong>Parameter:</strong> Variabel di dalam kurung saat <em>definisi</em> (contoh: `nama`).</li>
                        <li><strong>Argumen:</strong> Nilai asli yang dikirim saat <em>pemanggilan</em> (contoh: `"Budi"`).</li>
                    </ul>
                </div>

                <div class="bg-gray-100 p-4 rounded font-mono text-sm">
                    def selamat(nama): <span class="text-gray-500"># nama adalah parameter</span><br>
                    &nbsp;&nbsp;print("Hai " + nama)<br><br>
                    selamat("Ali") <span class="text-gray-500"># "Ali" adalah argumen</span>
                </div>
            ',
            'description' => 'Tugas: Buat fungsi `perkenalan(nama, asal)` yang mencetak "Halo [nama] dari [asal]". Panggil dengan nama "Siti" dan asal "Bandung".',
            'initial_code' => "def perkenalan(nama, asal):\n    print(f\"Halo {nama} dari {asal}\")\n\n# Panggil fungsi di bawah\n",
            'expected_output' => "Halo Siti dari Bandung",
            'order' => 2
        ]);

        // MATERI 3: Return Value
        Challenge::create([
            'course_id' => $c5->id,
            'title' => 'Mengembalikan Nilai (Return)',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Output Fungsi</h3>
                <p class="mb-4 text-gray-600">
                    Fungsi tidak harus selalu mencetak (print) sesuatu. Seringkali, fungsi bertugas menghitung lalu <strong>mengembalikan (return)</strong> hasilnya ke pemanggil untuk diproses lebih lanjut.
                </p>

                <div class="bg-gray-100 p-4 rounded border border-gray-200 font-mono text-sm mb-4">
                    def tambah(a, b):<br>
                    &nbsp;&nbsp;<span class="text-purple-600 font-bold">return</span> a + b<br><br>
                    hasil = tambah(5, 3)<br>
                    print(hasil) <span class="text-gray-500"># Output: 8</span>
                </div>
                
                <p class="text-sm text-gray-500">Jika tidak ada `return`, fungsi akan mengembalikan `None`.</p>
            ',
            'description' => 'Tugas: Buat fungsi `kali(x, y)` yang mengembalikan (return) hasil perkalian x dan y. Print hasil dari `kali(10, 5)`.',
            'initial_code' => "def kali(x, y):\n    return ...\n\n# Print hasil pemanggilan kali(10, 5)\nprint(...)",
            'expected_output' => "50",
            'order' => 3
        ]);

        // MATERI 4: Argumen Default & Keyword
        Challenge::create([
            'course_id' => $c5->id,
            'title' => 'Jenis-Jenis Argumen',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Fleksibilitas Argumen</h3>
                <p class="mb-4 text-gray-600">Python mendukung beberapa cara pengiriman argumen:</p>

                <div class="space-y-4">
                    <div class="bg-white p-3 rounded border shadow-sm">
                        <strong class="text-blue-600 block mb-1">1. Keyword Arguments</strong>
                        <p class="text-sm text-gray-600">Menyebut nama parameter, jadi urutan tidak masalah.</p>
                        <code class="text-xs bg-gray-100 px-1">fungsi(umur=20, nama="Budi")</code>
                    </div>
                    
                    <div class="bg-white p-3 rounded border shadow-sm">
                        <strong class="text-green-600 block mb-1">2. Default Arguments</strong>
                        <p class="text-sm text-gray-600">Nilai cadangan jika argumen tidak diisi.</p>
                        <code class="text-xs bg-gray-100 px-1">def fungsi(pesan="Halo"):</code>
                    </div>

                    <div class="bg-white p-3 rounded border shadow-sm">
                        <strong class="text-purple-600 block mb-1">3. *args & **kwargs</strong>
                        <p class="text-sm text-gray-600">Menerima jumlah argumen tak terbatas (sebagai tuple/dictionary).</p>
                    </div>
                </div>
            ',
            'description' => 'Tugas: Fungsi `pangkat(angka, eksponen=2)` (default pangkat 2). Panggil fungsi hanya dengan argumen angka 5 (sehingga dikuadratkan). Print hasilnya.',
            'initial_code' => "def pangkat(angka, eksponen=2):\n    return angka ** eksponen\n\n# Panggil pangkat(5) dan print hasilnya\n",
            'expected_output' => "25",
            'order' => 4
        ]);

        // MATERI 5: Fungsi Bawaan (Built-in)
        Challenge::create([
            'course_id' => $c5->id,
            'title' => 'Fungsi Bawaan (Built-in)',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Alat Siap Pakai</h3>
                <p class="mb-4 text-gray-600">
                    Python sudah menyediakan banyak fungsi hebat yang siap pakai tanpa perlu kita definisikan.
                </p>

                <div class="grid grid-cols-2 gap-4 text-sm font-mono text-gray-700 mb-6">
                    <div class="bg-gray-100 p-2 rounded">print()</div>
                    <div class="bg-gray-100 p-2 rounded">len() <span class="text-gray-400">// Panjang data</span></div>
                    <div class="bg-gray-100 p-2 rounded">type() <span class="text-gray-400">// Cek tipe data</span></div>
                    <div class="bg-gray-100 p-2 rounded">max() <span class="text-gray-400">// Nilai terbesar</span></div>
                    <div class="bg-gray-100 p-2 rounded">sum() <span class="text-gray-400">// Total jumlah</span></div>
                    <div class="bg-gray-100 p-2 rounded">str(), int() <span class="text-gray-400">// Konversi</span></div>
                </div>
            ',
            'description' => 'Tugas: Diberikan list `nilai = [10, 50, 30, 90]`. Gunakan fungsi `max()` untuk mencari nilai tertinggi, lalu print.',
            'initial_code' => "nilai = [10, 50, 30, 90]\n# Cari nilai terbesar\nterbesar = ...\nprint(terbesar)",
            'expected_output' => "90",
            'order' => 5
        ]);

        // MATERI 6: Latihan Studi Kasus
        Challenge::create([
            'course_id' => $c5->id,
            'title' => 'Latihan: Hitung Rata-rata',
            'content' => '
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Studi Kasus: Statistik Sederhana</h3>
                <p class="mb-4 text-gray-600 leading-relaxed">
                    Mari kita gabungkan pemahaman tentang fungsi, parameter, dan return value.
                </p>
                
                <div class="bg-blue-50 p-4 rounded border border-blue-100">
                    <p class="font-bold text-blue-800 mb-2">Instruksi:</p>
                    <ol class="list-decimal pl-5 text-sm text-blue-700 space-y-2">
                        <li>Buat fungsi <code>hitung_rata_rata</code> yang menerima 3 parameter angka (a, b, c).</li>
                        <li>Hitung rata-ratanya: <code>(a + b + c) / 3</code>.</li>
                        <li>Kembalikan (return) hasil perhitungan tersebut.</li>
                        <li>Panggil fungsi dengan angka 10, 20, 30 dan print hasilnya.</li>
                    </ol>
                </div>
            ',
            'description' => 'Tugas: Implementasikan fungsi hitung_rata_rata sesuai instruksi.',
            'initial_code' => "def hitung_rata_rata(a, b, c):\n    # Tulis rumus di sini\n    return ...\n\n# Panggil dengan 10, 20, 30 dan print\nhasil = ...\nprint(hasil)",
            'expected_output' => "20.0",
            'order' => 6
        ]);
    }
}