<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasTJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kas_t_jenis')->insert([
            [
                'id' => 1,
                'nama' => 'masuk',
            ],
            [
                'id' => 2,
                'nama' => 'keluar',
            ],

        ]);
    }
}
