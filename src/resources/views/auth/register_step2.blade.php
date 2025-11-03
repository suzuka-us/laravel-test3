@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2>初期体重登録</h2>
    <form method="POST" action="{{ route('register.step2.post') }}">
        @csrf

        <div class="form-group">
            <label for="current_weight">現在の体重(kg)</label>
            <input type="number" step="0.1" name="current_weight" id="current_weight" value="{{ old('current_weight') }}" required>
            @error('current_weight')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="target_weight">目標体重(kg)</label>
            <input type="number" step="0.1" name="target_weight" id="target_weight" value="{{ old('target_weight') }}" required>
            @error('target_weight')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit">アカウント作成</button>
    </form>
</div>
@endsection


