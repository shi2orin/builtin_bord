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
    public function show(Request $request)
    {
        $posts = Post::with('user', 'postComments', 'subCategory')->get();
        $main_categories = PostMainCategory::get();
        $sub_categories = PostSubCategory::get();
        $favorite = new PostFavorite;
        $post_comment = new Post;
        if (!empty($request->keyword)) {
            $posts = Post::with('user', 'postComments', 'subCategory')
                ->where('title', 'like', '%' . $request->keyword . '%')
                ->orWhere('post', 'like', '%' . $request->keyword . '%')
                ->orWhereHas('subCategory', function ($q) use ($request) {
                    $q->where('sub_category', $request->keyword);
                })
                ->get();
        } else if ($request->category_word) {
            $posts = Post::with('user', 'postComments', 'subCategory')
                ->whereHas('subCategories', function ($q) use ($request) {
                    $q->where('sub_category', $request->category_word);
                })
                ->get();
        } else if ($request->favorite_posts) {
            $favorites = Auth::user()->favoritePostId()->get('post_id');
            $posts = Post::with('user', 'postComments')
                ->whereIn('id', $favorites)->get();
        } else if ($request->my_posts) {
            $posts = Post::with('user', 'postComments')
                ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.top', compact('posts', 'main_categories', 'sub_categories', 'favorite', 'post_comment'));
    }
}
