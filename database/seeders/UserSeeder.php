<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat User Admin untuk testing
        User::create([
            'name' => 'Siswa Python',
            'email' => 'siswa@python.test',
            'password' => Hash::make('password123'), // Passwordnya ini
        ]);
    }
}