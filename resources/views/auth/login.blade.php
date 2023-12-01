<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BuiltinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body>
  <form action="{{ route('loginPost') }}" method="POST">
    <div class="w-100 vh-100 d-flex flex-column" style="align-items:center;">
      <div class="w-50">
        <p class="font-weight-bold text-center" style="margin-top:100px;">ログイン</p>
        <div class="w-50 pt-5 m-auto">
          <label class="d-block mt-5">メールアドレス</label>
          <input type="text" name="email" class="d-block w-100" style="background-color:#f5f5f5;border-width:1px;">
        </div>
        <div class="w-50 pt-5 m-auto">
          <label class="d-block mt-5">パスワード</label>
          <input type="password" name="password" class="d-block w-100" style="background-color:#f5f5f5;border-width:1px;">
          <div class="text-right mt-5">
            <input type="submit" class="btn btn-primary" value="ログイン">
          </div>
        </div>
        <div class="w-50 pt-5 m-auto">
          <p class="font-weight-bold">新規ユーザー登録は<a href="{{ route('registerView') }}">こちら</a></p>
        </div>
      </div>
      {{ csrf_field() }}
    </div>
  </form>
</body>

</html>
