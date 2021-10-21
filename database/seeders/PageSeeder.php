<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pages = ['Hakkimizda',  'Iletişim', 'Kariyer', 'Vizyonumuz', 'Misyonumuz'];


        $count = 0;

        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([

                'title' => $page,
                'slug' => Str::slug($page),
                'image' => ' https://nextpittsburgh-images.s3.amazonaws.com/2020/02/25132730/FRL-Pittsburgh-3-scaled-e1582655271879.jpg',

                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.
                 Sit officiis ea assumenda possimus eligendi eaque veniam quam doloremque eos asperiores hic provident,
                  minus nisi culpa blanditiis voluptatibus distinctio, eius pariatur!',

                'order' => $count,

                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),

            ]);
        }
    }
}
