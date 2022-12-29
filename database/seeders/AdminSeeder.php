<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('admins')->insert([
        //     [
        //         'id' => 1,
        //         'nama' => 'vernandaspw',
        //         'email' => 'vernandaspw@gmail.com',
        //         'phone' => '089660741134',
        //         'password' => Hash::make('Merpati@341'),
        //         'google_id' => null,
        //         'code' => null,
        //         'code_expired_at' => null,
        //         'code_resend_at' => null,
        //         'last_seen_at' => null,
        //         'role' => 'superadmin',
        //         'isaktif' => true,
        //         'created_at' => now(),
        //     ],
        //     [
        //         'id' => 1,
        //         'nama' => 'doni',
        //         'email' => 'doni@gmail.com',
        //         'phone' => '082282998204',
        //         'password' => Hash::make('12345678aA'),
        //         'google_id' => null,
        //         'code' => null,
        //         'code_expired_at' => null,
        //         'code_resend_at' => null,
        //         'last_seen_at' => null,
        //         'role' => 'admin',
        //         'isaktif' => true,
        //         'created_at' => now(),
        //     ],
        // ]);
    }
}
