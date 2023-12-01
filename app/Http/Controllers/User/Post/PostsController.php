<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use Auth;
use Validator;
// 場所確認

class PostsController extends Controller
{
    public function top()
    {
        $posts = Post::with('user', 'postComments', 'subCategory')->get();
        $main_categories = PostMainCategory::get();
        $sub_categories = PostSubCategory::get();
        $favorite = new PostFavorite;
        $post_comment = new Post;
        return view('authenticated.top', compact('posts', 'main_categories', 'sub_categories', 'favorite', 'post_comment'));
    }
}
