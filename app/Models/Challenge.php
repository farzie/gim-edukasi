<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Challenge extends Model
{
    protected $guarded = [];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    // Cek apakah user yang login sudah menyelesaikan ini
    public function isCompleted() {
        if (!Auth::check()) return false;
        return \App\Models\UserProgress::where('user_id', Auth::id())
            ->where('challenge_id', $this->id)
            ->where('is_completed', true)
            ->exists();
    }
}