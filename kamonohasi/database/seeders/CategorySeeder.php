<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['category_id' => 0,
            'genre' =>'総記'],
            ['category_id' => 1,
            'genre' => '哲学'],
            ['category_id' => 2,
            'genre' =>'歴史'],
            ['category_id' => 3,
            'genre' =>'社会科学'],
            ['category_id' => 4,
            'genre' =>'自然科学'],
            ['category_id' => 5,
            'genre' =>'技術'],
            ['category_id' => 6,
            'genre' =>'産業'],
            ['category_id' => 7,
            'genre' =>'芸術'], 
            ['category_id' => 8,
            'genre' =>'言語'],
            ['category_id' => 9,
            'genre' =>'文学']
        ];
        \DB::table('categories')->insert($data);
    }
}
