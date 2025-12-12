<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $table = 'user_progress';

    // Kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'challenge_id',
        'is_completed'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Challenge
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}