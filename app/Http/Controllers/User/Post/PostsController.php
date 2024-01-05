<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\PostCommentFavorite;
use App\Models\ActionLogs\ActionLog;
use App\Models\Users\User;
use App\Http\Requests\PostFormRequest;
use Auth;
use Validator;
// 場所確認

class PostsController extends Controller
{
    public function show(Request $request)
    {
        $posts = Post::with('user', 'postComments', 'subCategories',)->get();
        $main_categories = PostMainCategory::get();
        $sub_categories = PostSubCategory::get();
        $favorite = new PostFavorite;
        $view = new Actionlog;
        $post_comment = new Post;
        if (!empty($request->keyword)) {
            $posts = Post::with('user', 'postComments', 'subCategories')
                ->where('title', 'like', '%' . $request->keyword . '%')
                ->orWhere('post', 'like', '%' . $request->keyword . '%')
                ->orWhereHas('subCategories', function ($q) use ($request) {
                    $q->where('sub_category', $request->keyword);
                })
                ->get();
        } else if ($request->category_word) {
            $posts = Post::with('user', 'postComments', 'subCategories')
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
        return view('authenticated.top', compact('posts', 'main_categories', 'sub_categories', 'favorite', 'post_comment', 'view'));
    }

    public function postDetail($post_id, Request $request)
    {
        ActionLog::create([
            'user_id' => Auth::id(),
            'post_id' => $post_id,
            'event_at' => now()
        ]);
        $post = Post::with('user', 'postComments', 'subCategories', 'favorites')->findOrFail($post_id);
        $favorite = new PostFavorite;
        $favorite_comment = new PostCommentFavorite;
        $view = new Actionlog;
        return view('authenticated.post_detail', compact('post', 'favorite', 'favorite_comment', 'view'));
    }

    public function newPost()
    {
        $main_categories = PostMainCategory::get();
        $sub_categories = PostSubCategory::get();
        return view('authenticated.post_create', compact('main_categories', 'sub_categories'));
    }

    public function postCreate(PostFormRequest $request)
    {

        $sub_category_id = $request->sub_category;
        Post::create([
            'user_id' => Auth::id(),
            'post_sub_category_id' => $sub_category_id,
            'title' => $request->title,
            'post' => $request->post_body,
            'event_at' => now()
        ]);

        return redirect()->route('top.show');
    }

    public function postEditShow($post_id)
    {
        $post = Post::with('user', 'subCategories')->findOrFail($post_id);
        $main_categories = PostMainCategory::get();
        $sub_categories = PostSubCategory::get();
        return view('authenticated.post_edit', compact('post', 'main_categories', 'sub_categories'));
    }

    public function postEdit(PostFormRequest $request)
    {

        Post::where('id', $request->post_id)->update([
            'title' => $request->title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('top.show');
    }

    public function postFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $favorite = new PostFavorite;

        $favorite->user_id = $user_id;
        $favorite->post_id = $post_id;
        $favorite->save();
        return response()->json();
    }

    public function postUnFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $favorite = new PostFavorite;


        $favorite->where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->delete();

        return response()->json();
    }
    public function postCommentFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_comment_id = $request->post_comment_id;

        $favorite_comment = new PostCommentFavorite;

        $favorite_comment->user_id = $user_id;
        $favorite_comment->post_comment_id = $post_comment_id;
        $favorite_comment->save();
        return response()->json();
    }

    public function postCommentUnFavorite(Request $request)
    {
        $user_id = Auth::id();
        $post_comment_id = $request->post_comment_id;

        $favorite_comment = new PostCommentFavorite;


        $favorite_comment->where('user_id', $user_id)
            ->where('post_comment_id', $post_comment_id)
            ->delete();

        return response()->json();
    }
}
