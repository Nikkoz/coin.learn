<?php

use App\Entities\Post;
use Illuminate\Database\Seeder;
use App\Entities\Coin\Handbook;

class PostTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Post::class, 300)->create()->each(static function (Post $post) {
            $limit = random_int(1, 5);
            $handbook = Handbook::inRandomOrder()->limit($limit)->get();
            $handbook = $handbook ?? factory(Handbook::class, $limit)->make();

            $post->handbooks()->sync($handbook);
        });
    }
}