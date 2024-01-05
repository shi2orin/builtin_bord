@extends('layouts.app')

@section('title', '掲示板投稿一覧')

@section('content')
<div class="board_area w-100 d-flex">
  <div class="post_view w-100 ml-0">
    @foreach($posts as $post)
    <div class="post_area border w-75 mb-5 p-3">
      <div class="d-flex justify-content-between">
        <p class="mr-auto">{{ $post->user->username }}さん</p>
        <p class="pr-3">{{ $post->created_at }}</p>
        <p class="pr-3">{{$view->viewCounts($post->id)}}View</p>
      </div>
      <h5 class="py-3 post_title"><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->title }}</a></h5>
      <div class="d-flex justify-content-between">
        <div class="mr-auto">
          <div class="btn btn-primary">{{$post->subCategories->sub_category}}</div>
        </div>
        <p class="pr-3 comment">コメント数<span class="pl-1">{{$post->commentCounts($post->id)}}</span></p>
        <div>
          @if(Auth::user()->is_Favorite($post->id))
          <p class="m-0"><i class="fas fa-heart un_favorite_btn" post_id="{{ $post->id }}"></i><span class="favorite_counts{{ $post->id }}">{{$favorite->favoriteCounts($post->id)}}</span></p>
          @else
          <p class="m-0"><i class="fas fa-heart favorite_btn" post_id="{{ $post->id }}"></i><span class="favorite_counts{{ $post->id }}">{{$favorite->favoriteCounts($post->id)}}</span></p>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25 mr-5">
    <div class="">
      @if(Auth::user()->admin_role ==1)
      <a class="btn btn-danger w-100 mb-4" href="{{ route('category.show') }}" role="button">カテゴリー追加</a>
      @endif
      <a class="btn btn-primary w-100 mb-4" href="{{ route('post.new') }}" role="button">投稿</a>
      <form action="{{ route('top.show') }}" method="get" id="postSearchRequest">
        <div class="d-flex mb-4">
          <input type="text" class="w-75 category_search border" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
          <input type="submit" class="w-25 btn btn-primary " value="検索" form="postSearchRequest">
        </div>
        <input type="submit" name="favorite_posts" class="btn btn-primary w-100 mb-4" value="いいねした投稿" form="postSearchRequest">
        <input type="submit" name="my_posts" class="btn btn-primary w-100 mb-4" value="自分の投稿" form="postSearchRequest">
        <div>
          <p>カテゴリー</p>
          <div class="category">
            @foreach($main_categories as $main_category)
            <div class="category_item">
              <p class="main_categories js-main_category border-bottom border-secondary">
                {{ $main_category->main_category }}
              </p>
              <div class="sub_category">
                <ul>
                  @foreach($sub_categories->where('post_main_category_id', $main_category->id) as $sub_category)
                  <li class="border-bottom border-secondary pt-3"><input type="submit" name="category_word" value="{{ $sub_category->sub_category }}" form="postSearchRequest" class="category_search">
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            @endforeach
          </div>
      </form>
    </div>
  </div>
</div>

@endsection
