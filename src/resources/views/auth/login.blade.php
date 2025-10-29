@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2>ログイン</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label>パスワード</label>
        <input type="password" name="password">
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <!-- ▼ここを変更 -->
        <div class="button-group">
            <button type="submit">ログイン</button>
        </div>
        <!-- ▲ここを追加 -->
    </form>
    <a href="{{ route('register.step1') }}">アカウント作成はこちら</a>
</div>
@endsection
