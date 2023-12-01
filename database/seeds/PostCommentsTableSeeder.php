<?php

use Illuminate\Database\Seeder;
use App\Models\Posts\PostComment;

class PostCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostComment::create([
            'user_id' => 3,
            'post_id' => 4,
            'comment' => 'コメント1',
            'event_at' => now(),

        ]);
        PostComment::create([
            'user_id' => 4,
            'post_id' => 4,
            'comment' => 'コメント2',
            'event_at' => now(),

        ]);
    }
}
