<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Posts\PostFavorite;
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

    // いいねしているかどうか
    public function is_Favorite($post_id)
    {
        return PostFavorite::where('user_id', Auth::id())->where('post_id', $post_id)->first(['post_favorites.id']);
    }

    public function favoritePostId()
    {
        return PostFavorite::where('user_id', Auth::id());
    }
}
