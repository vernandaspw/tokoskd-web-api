<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'nama' => 'vernandaspw',
                'email' => 'vernandaspw@gmail.com',
                'phone' => '082299998741',
                'password' => Hash::make('Merpati341'),
                'code' => null,
                'code_expired_at' => null,
                'code_resend_at' => null,
                'last_seen_at' => null,
                'role' => 'admin',
                'isaktif' => true,
                'created_at' => now(),

                'nip' => '20221201122102293',
                'gaji_pokok' => 3000000,
                'pinjaman' => 0
            ],
        ]);
    }
}
