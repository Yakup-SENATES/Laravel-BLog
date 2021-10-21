<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([

            'title' => 'Cihangir Hanzade',
            'active' => 1,
            'github' => 'https://github.com/Yakup-SENATES',
            'linkedin' => 'https://www.linkedin.com/in/yakup-%C5%9Fenate%C5%9F-33215a1b4/',
            'instagram' => 'https://www.instagram.com/tilltheend0146/',
            'created_at' => new DateTime(),
            'updated_at' => now(),
        ]);
    }
}
