<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Challenge;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Menampilkan daftar semua course/modul.
     */
    public function index()
    {
        // Ambil semua course
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Menampilkan detail satu course beserta daftar challenge-nya.
     */
    public function show($slug)
    {
        // Cari course berdasarkan slug
        // Eager load 'challenges' dan urutkan berdasarkan kolom 'order'
        $course = Course::where('slug', $slug)
            ->with(['challenges' => function($query) {
                $query->orderBy('order', 'asc');
            }])
            ->firstOrFail();
        
        return view('courses.show', compact('course'));
    }

    /**
     * Menampilkan halaman coding (Sandbox) untuk challenge tertentu.
     */
    public function challenge($slug, $challengeId)
    {
        // Ambil challenge berdasarkan ID, pastikan relasi course terbawa
        $challenge = Challenge::with('course')->findOrFail($challengeId);
        
        // Cek apakah slug di URL sesuai dengan course milik challenge ini
        if ($challenge->course->slug !== $slug) {
            abort(404);
        }

        // Cari challenge berikutnya untuk tombol "Lanjut"
        // Logikanya: Cari challenge di course yang sama, dengan urutan (order) lebih besar
        $nextChallenge = Challenge::where('course_id', $challenge->course_id)
            ->where('order', '>', $challenge->order)
            ->orderBy('order', 'asc')
            ->first();

        return view('courses.sandbox', compact('challenge', 'nextChallenge'));
    }

    // Menampilkan Halaman Teori (Lesson)
    public function lesson($slug, $challengeId)
    {
        $challenge = Challenge::with('course')->findOrFail($challengeId);
        
        // Navigasi Previous / Next di halaman materi
        $nextChallenge = Challenge::where('course_id', $challenge->course_id)
            ->where('order', '>', $challenge->order)
            ->orderBy('order', 'asc')
            ->first();
            
        $prevChallenge = Challenge::where('course_id', $challenge->course_id)
            ->where('order', '<', $challenge->order)
            ->orderBy('order', 'desc')
            ->first();

        return view('courses.lesson', compact('challenge', 'nextChallenge', 'prevChallenge'));
    }
}