<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\UserProgress;
use App\Models\Challenge;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil data Course beserta jumlah Challenge-nya
        $courses = Course::withCount('challenges')->get();

        // 2. Hitung progres user untuk setiap course
        // Kita modifikasi collection $courses agar punya properti 'progress_percent'
        $courses->transform(function ($course) use ($user) {
            
            // Hitung tantangan yang selesai di course ini
            $completedCount = UserProgress::where('user_id', $user->id)
                ->whereHas('challenge', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->where('is_completed', true)
                ->count();

            // Hitung persentase (hindari pembagian nol)
            $percent = $course->challenges_count > 0 
                ? round(($completedCount / $course->challenges_count) * 100) 
                : 0;

            $course->progress_percent = $percent;
            $course->completed_tasks = $completedCount;
            
            return $course;
        });

        // 3. Statistik Global (Header Dashboard)
        $totalCompletedGlobal = UserProgress::where('user_id', $user->id)->where('is_completed', true)->count();
        $totalChallengesGlobal = Challenge::count();
        
        return view('pages.dashboard', compact(
            'user', 
            'courses', 
            'totalCompletedGlobal',
            'totalChallengesGlobal'
        ));
    }
}