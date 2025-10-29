@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2>PiGLy</h2>
    <a href="#" id="openModal"><button>データを追加</button></a>
    <a href="{{ route('weight_logs.goal_edit') }}"><button>目標体重設定</button></a>
    <a href="{{ route('logout') }}"><button>ログアウト</button></a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>摂取カロリー</th>
                <th>運動時間</th>
                <th>運動内容</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($weight_logs as $log)
            <tr>
                <td>{{ $log->date }}</td>
                <td>{{ $log->weight }} kg</td>
                <td>{{ $log->calories }} cal</td>
                <td>{{ $log->exercise_time }}</td>
                <td>{{ $log->exercise_content }}</td>
                <td>
                    <a href="{{ route('weight_logs.edit', $log->id) }}">編集</a>
                    <form method="POST" action="{{ route('weight_logs.destroy', $log->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- モーダル -->
<div class="modal" id="modal">
    <div class="modal-content">
        <h3>体重登録</h3>
        <form method="POST" action="{{ route('weight_logs.create') }}">
            @csrf
            <label>日付</label>
            <input type="date" name="date" class="input-field" value="{{ old('date', date('Y-m-d')) }}">
            @error('date') <p class="error-message">{{ $message }}</p> @enderror

            <label>体重(kg)</label>
            <input type="number" step="0.1" name="weight" class="input-field" value="{{ old('weight') }}">
            @error('weight') <p class="error-message">{{ $message }}</p> @enderror

            <label>摂取カロリー</label>
            <input type="number" name="calories" class="input-field" value="{{ old('calories') }}">
            @error('calories') <p class="error-message">{{ $message }}</p> @enderror

            <label>運動時間</label>
            <input type="time" name="exercise_time" class="input-field" value="{{ old('exercise_time') }}">
            @error('exercise_time') <p class="error-message">{{ $message }}</p> @enderror

            <label>運動内容</label>
            <textarea name="exercise_content" class="input-field" rows="3">{{ old('exercise_content') }}</textarea>
            @error('exercise_content') <p class="error-message">{{ $message }}</p> @enderror

            <button type="submit">登録</button>
        </form>
        <button id="closeModal">戻る</button>
    </div>
</div>

<script>
const modal = document.getElementById('modal');
document.getElementById('openModal').onclick = e => { e.preventDefault(); modal.style.display='flex'; }
document.getElementById('closeModal').onclick = () => modal.style.display='none';
</script>
@endsection
