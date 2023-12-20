<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\PostCommentFavorite;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];

    public function posts()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }
    public function actionLogs()
    {
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }


    // いいねしているかどうか
    public function is_Favorite($post_id)
    {
        return PostFavorite::where('user_id', Auth::id())->where('post_id', $post_id)->first(['post_favorites.id']);
    }

    public function favoritePostId()
    {
        return PostFavorite::where('user_id', Auth::id());
    }

    public function is_FavoriteComment($post_comment_id)
    {
        return PostCommentFavorite::where('user_id', Auth::id())->where('post_comment_id', $post_comment_id)->first(['post_comment_favorites.id']);
    }

    public function favoriteCommentId()
    {
        return PostCommentFavorite::where('user_id', Auth::id());
    }
}
