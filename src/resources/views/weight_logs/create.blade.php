<h1>初期体重登録</h1>
<form method="POST" action="{{ route('register.step2') }}">
    @csrf
    <label>現在の体重</label>
    <input type="text" name="weight" value="{{ old('weight') }}">
    @error('weight') <p style="color:red">{{ $message }}</p> @enderror

    <label>目標体重</label>
    <input type="text" name="target_weight" value="{{ old('target_weight') }}">
    @error('target_weight') <p style="color:red">{{ $message }}</p> @enderror

    <label>目標達成日</label>
    <input type="date" name="target_date" value="{{ old('target_date') }}">
    @error('target_date') <p style="color:red">{{ $message }}</p> @enderror

    <button type="submit">アカウント作成</button>
</form>
