@extends('layouts.app')
@section('title','カテゴリー追加画面')

@section('content')
<div class="w-100 d-flex">
  <div class="category_create w-75">
    <div class="w-75">
      <div class="mb-3">
        @if($errors->first('main_category'))
        <span class="error_message">{{ $errors->first('main_category') }}</span>
        @endif
        <h5>新規メインカテゴリー</h5>
        <input type="text" class="w-75 mb-3" name="main_category" form="mainCategoryRequest">
        <input type="submit" value="登録" class="w-75 btn btn-primary p-1 my-1" form="mainCategoryRequest">
        <form action="{{ route('main.category.create') }}" method="post" id="mainCategoryRequest">{{ csrf_field() }}</form>
      </div>
    </div>

    <div class="w-75 mt-5">
      <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">{{ csrf_field() }}
        <h5>メインカテゴリー</h5>
        <select class="w-75 p-1" form="subCategoryRequest" name="main_category_id">
          @foreach($main_categories as $main_category)
          <option value="{{ $main_category->id }}">{{ $main_category->main_category }}</option>
          @endforeach
        </select>
        <div class="mt-3">
          @if($errors->first('sub_category'))
          <span class="error_message">{{ $errors->first('sub_category') }}</span>
          @endif
          <h5>新規サブカテゴリー</h5>
        </div>
        <input type="text" class="w-75 mb-3" name="sub_category" form="subCategoryRequest">
        <input type="submit" value="登録" class="w-75 btn btn-primary p-1 my-1" form="subCategoryRequest">
      </form>
    </div>
  </div>
  <div class="category_list w-25 mt-3">
    <h5 class="mb-3">カテゴリー一覧</h5>
    @foreach($main_categories as $main_category)
    <div class="my-3">
      <table>
        <tr>
          <td>
            {{ $main_category->main_category }}
          </td>
          <td>
            @if($sub_categories->where('post_main_category_id',$main_category->id)->isEmpty())
            <a class="btn btn-danger ml-3" href="{{ route('main.category.delete', ['id' => $main_category->id]) }}" role="button">削除</a>
            @endif
          </td>
        </tr>
      </table>
      <div class="ml-3 mt-1">
        @foreach($sub_categories->where('post_main_category_id', $main_category->id) as $sub_category)
        <table>
          <tr>
            <td>{{ $sub_category->sub_category }}</td>
            <td>
              <a class="btn btn-danger ml-3" href="{{ route('sub.category.delete', ['id' => $sub_category->id]) }}" role="button">削除</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection
