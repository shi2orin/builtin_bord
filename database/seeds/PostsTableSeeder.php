<?php

use Illuminate\Database\Seeder;
use App\Models\Posts\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'user_id' => 1,
            'post_sub_category_id' => 1,
            'update_user_id' => 4,
            'title' => 'Laravelがわかりません',
            'post' => 'Laravelが分かりません',
            'event_at' => now(),
        ]);
    }
}
