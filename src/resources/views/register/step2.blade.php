@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>PiGLy</h1>
    <h2>新規館員登録</h2>
    <h3 class="step-title">ステップ2 体重データ入力</h3>
    <form method="POST" action="{{ route('register.step2.post') }}">
        @csrf

        <label>現在の体重 (kg)</label>
        <input type="number" step="0.1" name="current_weight" value="{{ old('current_weight') }}">
        @error('current_weight') 
            <p class="error-message">{{ $message }}</p>
        @enderror

        <label>目標体重 (kg)</label>
        <input type="number" step="0.1" name="target_weight" value="{{ old('target_weight') }}">
        @error('target_weight') 
            <p class="error-message">{{ $message }}</p>
        @enderror

        <div class="button-group">
            <button type="submit">アカウント作成</button>
        </div>
    </form>
</div>
@endsection
