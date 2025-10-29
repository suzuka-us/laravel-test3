<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <h1>新規会員登録</h1>
    <form action="{{ route('register.step1.post') }}" method="POST">
        @csrf

        <label for="name">名前</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name')
            <p class="error-message">{{ $message }}</p>
        @enderror

        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <p class="error-message">{{ $message }}</p>
        @enderror

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password">
        @error('password')
            <p class="error-message">{{ $message }}</p>
        @enderror

        <input type="submit" value="次へ進む">
    </form>
</div>
</body>
</html>
