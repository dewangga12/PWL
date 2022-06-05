<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mahasiswa_MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'mahasiswa_id' => 1,
                'matakuliah_id' => 1,
                'nilai' => 84
            ],
            [
                'mahasiswa_id' => 1,
                'matakuliah_id' => 2,
                'nilai' => 90
            ],
            [
                'mahasiswa_id' => 1,
                'matakuliah_id' => 3,
                'nilai' => 78
            ],
            [
                'mahasiswa_id' => 1,
                'matakuliah_id' => 4,
                'nilai' => 81
            ],
            [
                'mahasiswa_id' => 2,
                'matakuliah_id' => 1,
                'nilai' => 83
            ],
            [
                'mahasiswa_id' => 2,
                'matakuliah_id' => 2,
                'nilai' => 95
            ],
            [
                'mahasiswa_id' => 2,
                'matakuliah_id' => 3,
                'nilai' => 91
            ],
            [
                'mahasiswa_id' => 4,
                'matakuliah_id' => 1,
                'nilai' => 81
            ],
            [
                'mahasiswa_id' => 4,
                'matakuliah_id' => 2,
                'nilai' => 92
            ],
            [
                'mahasiswa_id' => 4,
                'matakuliah_id' => 3,
                'nilai' => 89
            ],
            [
                'mahasiswa_id' => 4,
                'matakuliah_id' => 4,
                'nilai' => 85
            ],
        ];

        DB::table('mahasiswa_matakuliah')->insert($data);
    }
}
