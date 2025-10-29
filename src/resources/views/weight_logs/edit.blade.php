<h1>体重更新</h1>

<form method="POST" action="{{ route('weight_logs.edit', $log->id) }}">
    @csrf
    <label>日付</label>
    <input type="date" name="date" value="{{ old('date', $log->date) }}">
    @error('date') <p style="color:red">{{ $message }}</p> @enderror

    <label>体重</label>
    <input type="text" name="weight" value="{{ old('weight', $log->weight) }}">
    @error('weight') <p style="color:red">{{ $message }}</p> @enderror

    <label>摂取カロリー</label>
    <input type="number" name="calories" value="{{ old('calories', $log->calories) }}">
    @error('calories') <p style="color:red">{{ $message }}</p> @enderror

    <label>運動時間</label>
    <input type="time" name="exercise_time" value="{{ old('exercise_time', $log->exercise_time) }}">
    @error('exercise_time') <p style="color:red">{{ $message }}</p> @enderror

    <label>運動内容</label>
    <textarea name="exercise_content">{{ old('exercise_content', $log->exercise_content) }}</textarea>
    @error('exercise_content') <p style="color:red">{{ $message }}</p> @enderror

    <button type="submit">更新</button>
    <a href="{{ route('weight_logs.index') }}">戻る</a>
</form>

<form method="POST" action="{{ route('weight_logs.destroy', $log->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit">削除</button>
</form>
