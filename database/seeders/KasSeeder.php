<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kas')->insert([
            [
                'id' => 1,
                'no' => 1,
                'tipe' => 'tunai',
                'nama' => 'kas besar tunai',
                'saldo' => 0,
            ],
        ]);
    }
}
