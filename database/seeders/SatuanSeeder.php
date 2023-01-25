<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satuans')->insert([
            [
                'satuan' => 'pcs',
            ],
            [
                'nama' => 'pak',
            ],
            [
                'nama' => 'dus',
            ],
            [
                'nama' => 'set',
            ],
            [
                'nama' => 'sak',
            ],
            [
                'nama' => 'rim',
            ]

        ]);
    }
}
