<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            [
                'id' => 1,
                'name' => 'User',
               
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'HRD',
               
                'created_at' => now(),
            ],
            
        ];

        Role::insert($role);
    }
}
