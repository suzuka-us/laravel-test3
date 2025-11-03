@extends('layouts.app')

@section('content')
<div class="form-container">

    <!-- 修正：h2 → h1にしてページタイトルを追加 -->
    <h1 class="page-title">PiGLy - 体重管理</h1>

    <div class="button-group">
        <!-- 修正：データ追加ボタンはリンクではなくボタン単体に -->
        <button id="openModal">データを追加</button>

        <!-- 変更なし：目標体重設定 -->
        <a href="{{ route('weight_logs.goal_edit') }}"><button type="button">目標体重設定</button></a>

        <!-- 修正：ログアウトはPOSTに変更 -->
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
    </div>
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
                <!-- 修正：日付のフォーマット -->
                <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>

                <!-- 修正：体重の小数点1桁表示 -->
                <td>{{ number_format($log->weight, 1) }} kg</td>

                <td>{{ $log->calories }} cal</td>
                <td>{{ $log->exercise_time }}</td>
                <td>{{ $log->exercise_content }}</td>
                <td>
                    <!-- 修正：編集リンクにアイコンを追加 -->
                    <a href="{{ route('weight_logs.edit', $log->id) }}" class="edit-btn">✏️</a>

                    <!-- 修正：削除ボタンをインラインフォームに -->
                    <form method="POST" action="{{ route('weight_logs.destroy', $log->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- 修正：モーダル追加 -->
<div class="modal" id="modal">
    <div class="modal-content">
        <h3>体重登録</h3>

        <!-- 修正：routeはstoreに変更 -->
        <form method="POST" action="{{ route('weight_logs.store') }}">
            @csrf

            <label>日付</label>
            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
            @error('date') <p class="error-message">{{ $message }}</p> @enderror

            <label>体重(kg)</label>
            <input type="number" step="0.1" name="weight" value="{{ old('weight') }}">
            @error('weight') <p class="error-message">{{ $message }}</p> @enderror

            <label>摂取カロリー</label>
            <input type="number" name="calories" value="{{ old('calories') }}">
            @error('calories') <p class="error-message">{{ $message }}</p> @enderror

            <label>運動時間</label>
            <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
            @error('exercise_time') <p class="error-message">{{ $message }}</p> @enderror

            <label>運動内容</label>
            <textarea name="exercise_content" rows="3">{{ old('exercise_content') }}</textarea>
            @error('exercise_content') <p class="error-message">{{ $message }}</p> @enderror

            <button type="submit">登録</button>
        </form>

        <!-- 修正：戻るボタンにクラスを追加 -->
        <button id="closeModal" class="back-btn">戻る</button>
    </div>
</div>

<!-- 修正：モーダル開閉スクリプト -->
<script>
const modal = document.getElementById('modal');
document.getElementById('openModal').onclick = e => { e.preventDefault(); modal.style.display='flex'; }
document.getElementById('closeModal').onclick = () => modal.style.display='none';
</script>
@endsection
