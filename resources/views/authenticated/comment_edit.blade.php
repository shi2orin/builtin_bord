@extends('layouts.app')
@section('title','コメント編集画面')
@section('content')

<form action="{{ route('comment.edit') }}" method="post" id="commentEdit">{{ csrf_field() }}
  <div class="w-75 d-flex flex-column">
    @if($errors->first('comment'))
    <span class="error_message">{{ $errors->first('comment') }}</span>
    @endif
    <label class="mb-0">コメント</label>
    <textarea form="commentEdit" name="comment" class="mb-3" rows="3">{{ $comment->comment }}</textarea>
    <input type="hidden" form="commentEdit" name="post_id" value="{{$comment->post_id}}">
    <input type="hidden" form="commentEdit" name="comment_id" value="{{$comment->id}}">
    <input type="submit" class="btn btn-danger mb-3" value="編集">
  </div>
</form>
<a class="btn btn-danger w-75" href="{{ route('comment.delete', ['id' => $comment->id]) }}" role="button">削除</a>


@endsection
