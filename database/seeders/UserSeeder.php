<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'id' => '1',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'Admin',
                'remember_token' => 'null',
                'created_at' => now(),
            ],

            [
                'id' => '2',
                'name' => 'HR Baru',
                'email' => 'hr@mail.com',
                'password' => bcrypt('hr123'),
                'role' => 'HRD',
                'remember_token' => 'null',
                'created_at' => now(),
            ],
            [
                'id' => '3',
                'name' => 'Toni',
                'email' => 'toni@gmail.com',
                'password' => bcrypt('toni123'),
                'role' => 'HRD',
                'remember_token' => 'null',
                'created_at' => now(),
            ],
            [
                'id' => '4',
                'name' => 'Yeni',
                'email' => 'yeni@gmail.com',
                'password' => bcrypt('yeni123'),
                'role' => 'HRD',
                'remember_token' => 'null',
                'created_at' => now(),
            ],
           
        ];

        User::insert($user);
    }
}
