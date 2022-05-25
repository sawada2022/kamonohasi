<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('UTC');
        $start = strtotime('1950-01-01');
        $end = strtotime('2022-05-18');
        for ($i = 1; $i <= 100; $i++) {
            $r = rand(0, 4);
            $deleted = null;
            if($r == 0){
                $deleted =date("Y-m-d", mt_rand($start, $end));
            }
            $book = new \App\Models\Book([
                'isbn' => 123456789000 + $i,
                'category_id' => rand(1,10),
                'title' => 'サンプル本' . $i,
                'author' => '作者' . $i,
                'publisher' => '出版社' . $i,
                'comment' => 'コメント' . $i,
                'published_on' => date("Y-m-d", mt_rand($start, $end)),
                'deleted_on' => $deleted,
            ]);
            $book->save();
        }
    }
}
