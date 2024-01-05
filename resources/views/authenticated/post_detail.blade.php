@extends('layouts.app')
@section('title','掲示板詳細画面')
@section('content')
<div class="detail_post w-75 mb-5">
  <div class="d-flex">
    <div class="d-flex mr-auto">
      <p class="mr-3">{{ $post->user->username }}さん</p>
      <p>{{ $post->created_at }}</p>
    </div>
    <div>
      @if (Auth::user()->id ==$post->user_id)
      <a class="btn btn-danger" href="{{ route('post.edit.show', ['id' => $post->id]) }}" role="button">編集</a>
      @endif
    </div>
    <p class="ml-4">
    <p class="pr-3">{{$view->viewCounts($post->id)}}View</p>
  </div>
  <h5 class="py-3">{{ $post->title }}</h5>
  <p class="pl-3 pb-3">{{$post->post}}</p>
  <div class="d-flex justify-content-between">
    <div class="flex-grow-1">
      <div class="btn btn-primary">{{$post->subCategories->sub_category}}</div>
    </div>
    <p class="pr-3">コメント数<span class="pl-1">{{$post->commentCounts($post->id)}}</span></p>
    <div>
      @if(Auth::user()->is_Favorite($post->id))
      <p class="m-0"><i class="fas fa-heart un_favorite_btn" post_id="{{ $post->id }}"></i><span class="favorite_counts{{ $post->id }}">{{$favorite->favoriteCounts($post->id)}}</span></p>
      @else
      <p class="m-0"><i class="fas fa-heart favorite_btn" post_id="{{ $post->id }}"></i><span class="favorite_counts{{ $post->id }}">{{$favorite->favoriteCounts($post->id)}}</span></p>
      @endif
    </div>
  </div>
</div>
<div class="detail_comment w-75 mt-5">
  @foreach($post->postComments as $comment)
  <div class="comment_container border-bottom">
    <div class="d-flex mt-4 py-3">
      <p>{{ $comment->commentUser($comment->user_id)->username }}さん</p>
      <p class="ml-3">{{ $comment->created_at}}</p>
      <div class="ml-auto">
        @if (Auth::user()->id ==$comment->user_id)
        <a class="btn btn-danger" href="{{ route('comment.edit.show', ['id' => $comment->id]) }}" role="button">編集</a>
        @endif
      </div>
    </div>
    <div class="d-flex justify-content-between">
      <h6 class="mb-3">{{ $comment->comment }}</h6>
      <div>
        @if(Auth::user()->is_FavoriteComment($comment->id))
        <p class="m-0"><i class="fas fa-heart un_favorite_c_btn" post_comment_id="{{ $comment->id }}"></i><span class="favorite_comment_counts{{ $comment->id }}">{{$favorite_comment->favoriteCommentCounts($comment->id)}}</span></p>
        @else
        <p class="m-0"><i class="fas fa-heart favorite_c_btn" post_comment_id="{{ $comment->id }}"></i><span class="favorite_comment_counts{{ $comment->id }}">{{$favorite_comment->favoriteCommentCounts($comment->id)}}</span></p>
        @endif
      </div>
    </div>
  </div>
  @endforeach
</div>
<div class="w-75">
  <div class="comment_container mt-5">
    <div class="comment_area">
      <div>
        @if($errors->first('comment'))
        <span class="error_message">{{ $errors->first('comment') }}</span>
        @endif
      </div>
      <form action="{{ route('comment.create') }}" method="post" id="commentRequest">
        <textarea class="w-100" name="comment" rows="5" form="commentRequest" placeholder="こちらからコメントできます"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <div class="text-right">
          <input type="submit" class="btn btn-primary mb-5" form="commentRequest" value="コメント">
        </div>
        {{ csrf_field() }}
      </form>
    </div>
  </div>
</div>

@endsection
