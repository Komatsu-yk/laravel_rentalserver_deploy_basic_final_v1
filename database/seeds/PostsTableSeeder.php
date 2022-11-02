<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($id = 1; $id <= 10; $id++){
            $now   = new Datetime();  
            $posts = [
                [
                    'user_id'    => $id,
                    'comment'    => 'おはようございます'.rand(0, 9),
                    'image'      => '',
                    'created_at' => $now->modify('-'.rand(0, 100).'day')
                ],
                [
                    'user_id'    => $id,
                    'comment'    => 'こんにちは'.rand(0, 9),
                    'image'      => '',
                    'created_at' => $now->modify('-'.rand(0, 100).'day')
                ],
                [
                    'user_id'    => $id,
                    'comment'    => 'おやすみなさい'.rand(0, 9),
                    'image'      => '',
                    'created_at' => $now->modify('-'.rand(0, 100).'day')
                ],
            ];
            foreach($posts as $post){
                \App\Post::create($post);
            } 
        }
    }
}

