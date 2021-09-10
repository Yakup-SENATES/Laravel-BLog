<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $title = $faker->sentence(7);
        for ($i = 0; $i < 4; $i++) {
            DB::table('articles')->insert([
                'category_id' => rand(1, 9),
                'title' => $title,
                'image' => $faker->imageUrl(800, 600, 'cats', true, 'Merhaba TheJC'),
                'content' => $faker->paragraph(6),
                'slug' => Str::slug($title),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
