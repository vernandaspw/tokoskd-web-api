<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasTKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kas_t_kategoris')->insert([
            [
                'kas_t_jenis_id' => 1,
                'nama' => 'penjualan',
            ],
            [
                'kas_t_jenis_id' => 1,
                'nama' => 'pendapatan lainnya',
            ],
            [
                'kas_t_jenis_id' => 1,
                'nama' => 'penagihan hutang penjualan',
            ],
            [
                'kas_t_jenis_id' => 1,
                'nama' => 'pendapatan diluar usaha',
            ],
            // ------------------------------------------------------
            [
                'kas_t_jenis_id' => 1,
                'nama' => 'penambahan modal',
            ],
            [
                'kas_t_jenis_id' => 1,
                'nama' => 'terima pinjaman',
            ],
            [
                'kas_t_jenis_id' => 1,
                'nama' => 'penagihan hutang',
            ],

            // =======================================================

            [
                'kas_t_jenis_id' => 2,
                'nama' => 'pembelian persediaan',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'biaya ongkos kirim',
            ],

            [
                'kas_t_jenis_id' => 2,
                'nama' => 'biaya upah kerja',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'biaya gaji karyawan',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'biaya operasional',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'biaya listrik',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'biaya air',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'biaya sewa',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'pengeluaran diluar usaha',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'pengeluaran lainnya',
            ],
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'pembayaran hutang usaha',
            ],
            // ---------------------------------------------------------
            [
                'kas_t_jenis_id' => 2,
                'nama' => 'pemberian hutang',
            ],
            // ==========================================================

            [
                'kas_t_jenis_id' => null,
                'nama' => 'transfer',
            ]
        ]);
    }
}
