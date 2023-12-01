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
    <form action="{{ route('registerPost') }}" method="POST">
        <div class="w-100 vh-100 d-flex flex-column" style="align-items:center;">
            <div class="w-50">
                <p class="font-weight-bold text-center mt-5">ユーザー登録</p>
                <form method="POST" action="{{ route('registerPost') }}">
                    @csrf
                    <div class="w-50 pt-1 m-auto">
                        <label class="d-block mt-5">ユーザーネーム</label>
                        <input type="text" name="username" class="d-block w-100" style="background-color:#f5f5f5;border-width:1px;">
                        @error('username')
                        <li>{{$message}}</li>
                        @enderror
                    </div>
                    <div class="w-50 pt-1 m-auto">
                        <label class="d-block mt-5">メールアドレス</label>
                        <input type="text" name="email" class="d-block w-100" style="background-color:#f5f5f5;border-width:1px;">
                        @error('email')
                        <li>{{$message}}</li>
                        @enderror
                    </div>
                    <div class="w-50 pt-1 m-auto">
                        <label class="d-block mt-5">パスワード</label>
                        <input type="password" name="password" class="d-block w-100" style="background-color:#f5f5f5;border-width:1px;">
                        @error('password')
                        <li>{{$message}}</li>
                        @enderror
                    </div>
                    <div class="w-50 pt-1 m-auto">
                        <label class="d-block mt-5">パスワード確認</label>
                        <input type="password" name="password_confirmation" class="d-block w-100" style="background-color:#f5f5f5;border-width:1px;">
                        @error('password')
                        <li>{{ $message }}</li>
                        @enderror
                        <div class="text-right mt-5">
                            <input type="submit" class="btn btn-primary" value="確認">
                        </div>
                    </div>
</body>
