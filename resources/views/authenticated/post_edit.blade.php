@extends('layouts.app')
@section('title','投稿編集画面')
@section('content')

<form action="{{ route('post.edit') }}" method="post" id="postEdit">{{ csrf_field() }}
  <div class="w-75 d-flex flex-column">
    <label class="mb-0">サブカテゴリー</label>
    <select class="w-100 mb-3 p-1" form="postEdit" name="sub_category">
      @foreach($sub_categories as $sub_category)
      <option class="sub_category_name" value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}</option>
      @endforeach
    </select>
    @if($errors->first('title'))
    <span class="error_message">{{ $errors->first('title') }}</span>
    @endif
    <label class="mb-0">タイトル</label>
    <input type="text" form="postEdit" name="title" value="{{ $post->title }}" class="mb-3">
    @if($errors->first('post_body'))
    <span class="error_message">{{ $errors->first('post_body') }}</span>
    @endif
    <label class="mb-0">投稿内容</label>
    <textarea form="postEdit" name="post_body" class="mb-3" rows="5">{{ $post->post }}</textarea>
    <input type="hidden" form="postEdit" name="post_id" value="{{$post->id}}">
    <input type="submit" class="btn btn-danger mb-3" value="編集">
  </div>
</form>
<a class="btn btn-danger w-75" href="{{ route('post.delete', ['id' => $post->id]) }}" role="button">削除</a>

@endsection
