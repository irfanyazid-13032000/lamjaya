<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisi = [
            [
                'id' => 1,
                'name' => 'Laravel',
               
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'HRD',
                
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Content Creator',
               
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Content Research',
                
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Social Media',
               
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Design',
                
                'created_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Moderator',
                
                'created_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Public Relation',
              
                'created_at' => now(),
            ],
        ];

        Divisi::insert($divisi);
    }
}
