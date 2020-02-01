<?php

use App\Entities\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Post::class, 300)->create();
    }
}