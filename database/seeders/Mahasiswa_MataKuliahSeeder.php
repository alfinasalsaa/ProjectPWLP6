<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $datas = [
            [
                'mahasiswa_id' => 2141720044,
                'matakuliah_id' => 1,
                'nilai' => 100,
            ],
            [
                'mahasiswa_id' => 2141720044,
                'matakuliah_id' => 2,
                'nilai' => 50,
            ],
            [
                'mahasiswa_id' => 2141720044,
                'matakuliah_id' => 3,
                'nilai' => 90,
            ],
            [
                'mahasiswa_id' => 245678901,
                'matakuliah_id' => 4,
                'nilai' => 50,
            ],
            [
                'mahasiswa_id' => 245678901,
                'matakuliah_id' => 1,
                'nilai' => 80,
            ],
            [
                'mahasiswa_id' => 245678901,
                'matakuliah_id' => 2,
                'nilai' => 95,
            ],
            [
                'mahasiswa_id' => 245678901,
                'matakuliah_id' => 3,
                'nilai' => 90,
            ],
            [
                'mahasiswa_id' => 2141720050,
                'matakuliah_id' => 4,
                'nilai' => 85,
            ],
        ];
        DB::table('mahasiswa_matakuliah')->insert($datas);
    
    }
}
