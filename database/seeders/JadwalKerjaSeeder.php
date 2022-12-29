<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jadwal_kerjas')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'shift' => null,
                'hari' => 'senin',
                'jam_masuk' => '06:00',
                'jam_keluar' => '18:00',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'shift' => null,
                'hari' => 'selasa',
                'jam_masuk' => '06:00',
                'jam_keluar' => '18:00',
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'shift' => null,
                'hari' => 'rabu',
                'jam_masuk' => '06:00',
                'jam_keluar' => '18:00',
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'shift' => null,
                'hari' => 'kamis',
                'jam_masuk' => '06:00',
                'jam_keluar' => '18:00',
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'shift' => null,
                'hari' => 'jumat',
                'jam_masuk' => '06:00',
                'jam_keluar' => '18:00',
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'shift' => null,
                'hari' => 'sabtu',
                'jam_masuk' => '06:00',
                'jam_keluar' => '18:00',
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'shift' => null,
                'hari' => 'minggu',
                'jam_masuk' => '06:00',
                'jam_keluar' => '18:00',
            ],
        ]);
    }
}
