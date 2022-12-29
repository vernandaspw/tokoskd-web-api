<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perusahaans')->insert([
            [
                'id' => 1,
                'nama_toko' => 'TOKO SKD',
                'img' => null,
                'provinsi'=> 'Sumatera Selatan',
                'daerah' => 'Lalan P5 RT3',
                'alamat' => 'Mulya jaya RT3',
                'telp' => null,
                'npwp' => null,
                'created_at' => now(),
            ],
        ]);
    }
}
