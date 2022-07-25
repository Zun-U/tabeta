<?php

use Carbon\Carbon; //Carbonライブラリの使用
use Illuminate\Support\Facades\DB; //DBライブラリの使用

use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['煮込みうどん', '野菜パンケーキ', 'お魚バーグ'];


        foreach ($titles as $title) {
            DB::table('recipes')->insert([
                'title' => $title,
                'cooking_time' => '10分',
                'ages' => '1歳',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
