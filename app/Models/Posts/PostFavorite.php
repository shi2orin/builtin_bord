<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostFavorite extends Model
{
    protected $table = 'post_favorites';

    protected $fillable = [
        'user_id',
        'post__id',
    ];

    public function favoriteCounts($post_id)
    {
        return PostFavorite::where('post_id', $post_id)->get()->count();
    }
}
