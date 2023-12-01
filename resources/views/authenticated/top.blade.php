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
  <div class="other_area w-25 mr-5">
    <div class="m-4">
      <a class="btn btn-primary w-100 mb-4" href="{{ route('loginView') }}" role="button">投稿</a>
      <div class="d-flex mb-4">
        <input type="text" class="w-75 category_search" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" class="w-25 btn btn-primary " value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="btn btn-primary w-100 mb-4" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="btn btn-primary w-100 mb-4" value="自分の投稿" form="postSearchRequest">
      <div>
        <p>カテゴリ-</p>
        <div class="category">

          @foreach($main_categories as $main_category)
          <div class="category_item">
            <p class="main_category js-main_category border-bottom border-secondary">
              {{ $main_category->main_category }}
            </p>
            <!--/.accordion-title-->
            <div class="sub_category">
              <ul>
                @foreach($sub_categories->where('main_category_id', $main_category->id) as $sub_category)
                <li class="border-bottom border-secondary pt-3"><input type="submit" name="category_word" value="{{ $sub_category->sub_category }}" form="postSearchRequest" style="border:none;">
                </li>
                @endforeach
              </ul>
            </div>
            <!--/.accordion-content sub_category-->
          </div>
          @endforeach
          <!--/.accordion-item main_category-->

          <!--/.accordion-container消した-->
        </div>
        <!--/.accordionはcategory-->

        <form action="{{ route('top.show') }}" method="get" id="postSearchRequest"></form>
      </div>
      <!-- otherareaのやつ -->
      <!-- bordareaのやつ -->
    </div>
  </div>
  @endsection
