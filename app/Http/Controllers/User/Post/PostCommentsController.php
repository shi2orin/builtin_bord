<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use App\Models\Posts\PostComment;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function commentEditShow($post_comment_id)
    {
        $comment = PostComment::findOrFail($post_comment_id);
        return view('authenticated.comment_edit', compact('comment'));
    }

    public function commentEdit(Request $request)
    {
        $request->validate(
            [
                'comment' => ['required', 'string', 'max:2500']
            ],
            [
                'comment.required' => '※コメント内容は必須です。',
                'comment.max' => '※コメントは2500文字以内で記入してください。',
            ]
        );

        PostComment::where('id', $request->comment_id)->update([
            'comment' => $request->comment,
        ]);
        $post_id = $request->post_id;
        return redirect()->route('post.detail', ['id' => $post_id]);
    }

    public function commentDelete($id)
    {
        PostComment::where('id', $id)->delete();
        return redirect()->route('post.detail');
    }
}
