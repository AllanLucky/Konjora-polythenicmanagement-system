<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'photo' => null,
                'phone' => '1234567890',
                'address' => '123 Admin Street',
                'city' => 'Admin City',
                'country' => 'Adminland',
                'gender' => 'male',
                'experience' => '10+ years in system administration',
                'job_title' => 'System Administrator',
                'department' => 'IT Department',
                'skills' => 'Laravel, Management, Security',
                'website' => 'https://linkedin.com/in/adminuser',
                'bio' => 'Enter your bio here',
                'day' => 1,
                'month' => 'January',
                'year' => 1985,
                'role' => 'admin',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Instructor',
                'name' => 'Instructor User',
                'email' => 'instructor@example.com',
                'password' => Hash::make('password'),
                'photo' => null,
                'phone' => '0987654321',
                'address' => '456 Instructor Avenue',
                'city' => 'Instructor City',
                'country' => 'Instructoria',
                'gender' => 'male',
                'experience' => '5+ years in teaching',
                'job_title' => 'Instructor',
                'department' => 'Education',
                'skills' => 'Teaching, Laravel, PHP',
                'website' => 'https://linkedin.com/in/instructoruser',
                'bio' => 'Enter your bio here',
                'day' => 15,
                'month' => 'March',
                'year' => 1990,
                'role' => 'instructor',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'User',
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'photo' => null,
                'phone' => '5555555555',
                'address' => '789 User Lane',
                'city' => 'User City',
                'country' => 'Userland',
                'gender' => 'female',
                'experience' => '2+ years in administration',
                'job_title' => 'Manager',
                'department' => 'Operations',
                'skills' => 'Management, Coordination',
                'website' => 'https://linkedin.com/in/userprofile',
                'bio' => 'Enter your bio here',
                'day' => 20,
                'month' => 'June',
                'year' => 1995,
                'role' => 'user',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}