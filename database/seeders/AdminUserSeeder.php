<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nom' => 'Admin',
                'email' => 'admin@example.com',
                'mot_de_passe' => Hash::make('admin1234'),
                'role' => 'admin',
            ]
        );
    }
}