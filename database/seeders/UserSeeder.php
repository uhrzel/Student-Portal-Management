<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ])->assignRole(['admin', 'teacher', 'dean', 'student']);

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Teacher $i",
                'email' => "teacher$i@example.com",
                'password' => Hash::make('password'),
            ])->assignRole('teacher');
        }

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Dean $i",
                'email' => "dean$i@example.com",
                'password' => Hash::make('password'),
            ])->assignRole('dean');
        }
        $faker = Faker::create();

        for ($i = 1; $i <= 1000; $i++) {
            User::create([
                'name' => $faker->name, // Random name
                'email' => $faker->unique()->safeEmail, // Unique random email
                'password' => Hash::make('password'), // Default password
            ])->assignRole('student');
        }
    }
}
