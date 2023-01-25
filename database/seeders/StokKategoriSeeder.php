<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stok_kategoris')->insert([
        // masuk
            [
                'stok_jenis_id' => 1,
                'nama' => 'pembelian',
            ],
            [
                'stok_jenis_id' => 1,
                'nama' => 'retur penjualan',
            ],
            [
                'stok_jenis_id' => 1,
                'nama' => 'rakitan',
            ],
            // keluar
            [
                'stok_jenis_id' => 2,
                'nama' => 'penjualan',
            ],
            [
                'stok_jenis_id' => 2,
                'nama' => 'retur pembelian',
            ],
            [
                'stok_jenis_id' => 2,
                'nama' => 'bad stok',
            ],
            [
                'stok_jenis_id' => 2,
                'nama' => 'dirakit',
            ],
            [
                'stok_jenis_id' => null,
                'nama' => 'revisi',
            ],
            [
                'stok_jenis_id' => null,
                'nama' => 'opname',
            ],
        ]);
    }
}
