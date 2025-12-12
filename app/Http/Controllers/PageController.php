<?php

namespace App\Http\Controllers;

use App\Models\Course; // Pastikan baris ini ada
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $courses = Course::all();
        
        // PERBAIKAN: Tambahkan compact('courses') agar data dikirim ke view
        return view('pages.home', compact('courses'));
    }
    
    public function about()
    {
        return view('pages.about');
    }
    
    public function playground()
    {
        // Halaman editor bebas (tanpa tantangan spesifik)
        return view('pages.playground');
    }
    
    public function help()
    {
        // Halaman FAQ / Bantuan
        return view('pages.help');
    }
}