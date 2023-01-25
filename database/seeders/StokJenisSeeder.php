<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('stok_jenis')->insert([
            [
                'id' => 1,
                'nama' => 'masuk',
            ],
            [
                'id' => 2,
                'nama' => 'keluar',
            ]
        ]);
    }
}
