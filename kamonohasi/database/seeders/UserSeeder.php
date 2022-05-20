<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=100; $i++){
            $user = new \App\Models\User([
                'user_name'=>'名無しさん'. $i,
                'birthday'=>date('Y/m/d'),
                'adress'=>'新宿'. rand(1,9) . '丁目',
                'postal_code'=>'123-4567',
                'tel'=>'090-'.rand(1,9).rand(1,9).rand(1,9).rand(1,9).'-'.rand(1,9).rand(1,9).rand(1,9).rand(1,9),
                'email'=>'user'. $i. '@gmail.com',
            ]);
            $user->save();
        }
    }
}
