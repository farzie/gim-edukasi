<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Lindungi kolom id, sisanya boleh diisi
    protected $guarded = ['id'];

    // Relasi ke Challenges (Penting untuk halaman detail nanti)
    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}