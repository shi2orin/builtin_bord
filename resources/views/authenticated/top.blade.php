@extends('layouts.app')

@section('title', '掲示板投稿一覧')

@section('content')
<div class="board_area w-100 m-auto d-flex">
  <div class="post_view w-75 mt-5">
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <div class="d-flex justify-content-between">
        <p class="flex-grow-1">{{ $post->user->username }}さん</p>
        <p class="pr-3">{{ $post->created_at }}</p>
        <p class="pr-3">View</p>
      </div>
      <h5 class="py-3">{{ $post->title }}</h5>
      <div class="d-flex justify-content-between">
        <div class="flex-grow-1">
          <div class="btn btn-primary">{{$post->subCategory->sub_category}}</div>
        </div>
        <p class="pr-3">コメント数<span class="pl-1">{{$post->commentCounts($post->id)}}</span></p>
        <div>
          @if(Auth::user()->is_Favorite($post->id))
          <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="favorite_counts{{ $post->id }}">{{$favorite->favoriteCounts($post->id)}}</span></p>
          @else
          <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="favorite_counts{{ $post->id }}">{{$favorite->favoriteCounts($post->id)}}</span></p>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
