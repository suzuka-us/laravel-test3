<h1>目標体重変更</h1>

<form method="POST" action="{{ route('weight_logs.goal_edit') }}">
    @csrf
    <label>目標体重</label>
    <input type="text" name="target_weight" value="{{ old('target_weight', $goal->target_weight ?? '') }}">
    @error('target_weight') <p style="color:red">{{ $message }}</p> @enderror

    <label>目標達成日</label>
    <input type="date" name="target_date" value="{{ old('target_date', $goal->target_date ?? '') }}">
    @error('target_date') <p style="color:red">{{ $message }}</p> @enderror

    <button type="submit">更新</button>
    <a href="{{ route('weight_logs.index') }}">戻る</a>
</form>
