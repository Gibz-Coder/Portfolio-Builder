<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@portfoliobuilder.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create admin profile
        \App\Models\Profile::create([
            'user_id' => $admin->id,
            'title' => 'Portfolio Builder Administrator',
            'bio' => 'System administrator for Portfolio Builder platform.',
            'profession' => 'System Administrator',
            'about_me' => 'Managing and maintaining the Portfolio Builder platform.',
        ]);

        // Create demo user
        $user = \App\Models\User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'user',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create demo user profile
        \App\Models\Profile::create([
            'user_id' => $user->id,
            'title' => 'Full Stack Developer',
            'bio' => 'Passionate developer with 5+ years of experience in web development.',
            'phone' => '+1 (555) 123-4567',
            'location' => 'San Francisco, CA',
            'website' => 'https://johndoe.dev',
            'profession' => 'Full Stack Developer',
            'years_experience' => 5,
            'about_me' => 'I am a passionate full-stack developer with expertise in modern web technologies. I love creating innovative solutions and bringing ideas to life through code.',
        ]);
    }
}
