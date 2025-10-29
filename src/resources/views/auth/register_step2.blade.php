@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2>初期体重登録</h2>
    <form method="POST" action="{{ route('register.step2') }}">
        @csrf
        <label>現在の体重(kg)</label>
        <input type="number" step="0.1" name="current_weight" value="{{ old('current_weight') }}">
        @error('current_weight') <p class="error">{{ $message }}</p> @enderror

        <label>目標体重(kg)</label>
        <input type="number" step="0.1" name="target_weight" value="{{ old('target_weight') }}">
        @error('target_weight') <p class="error">{{ $message }}</p> @enderror

        <button type="submit">アカウント作成</button>
    </form>
</div>
@endsection
