<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $absensi = [
            [
                'id' => 1,
                'tanggal' => '2021-08-01',
                'user_id' => '1',
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '17:00:00',
                'deskripsi' => 'Mengerjakan tugas Laravel',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'tanggal' => '2021-08-05',
                'user_id' => '2',
                'jam_masuk' => '08:00:00',
                'jam_keluar' => '17:00:00',
                'deskripsi' => 'Mengerjakan tugas Design',
                'created_at' => now(),
            ],
        ];

        Absensi::insert($absensi);
    }
}
