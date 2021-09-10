<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Eğlence',  'Bilişim', 'Gezi', 'Teknoloji', 'Spor', 'GÜnlük'
        ];

        foreach ($categories as $category) {

            DB::table('categories')->insert([

                'name' => $category,
                'slug' => Str::slug($category),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),

            ]);
        }
    }
}
