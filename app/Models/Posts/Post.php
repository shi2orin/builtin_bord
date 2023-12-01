<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function postComments()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }
    public function Favorites()
    {
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\Posts\PostSubCategory', 'post_sub_category_id');
    }


    // コメント数
    public function commentCounts($post_id)
    {
        return PostComment::where('post_id', $post_id)->get()->count();
    }
}
