@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2>新規会員登録</h2>
    <h3 class="step-title">ステップ1：アカウント情報の登録</h3>
    <form method="POST" action="{{ route('register.step1') }}">
        @csrf
        <label>名前</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label>パスワード</label>
        <input type="password" name="password">
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">次に進む</button>
    </form>
    <a href="{{ route('login') }}">ログインはこちら</a>
</div>
@endsection
