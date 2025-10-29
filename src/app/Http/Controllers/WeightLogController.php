<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateWeightLogRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    // 体重管理画面
    public function index()
    {
        $user = Auth::user();
        $weightLogs = WeightLog::where('user_id', $user->id)->orderBy('date', 'desc')->paginate(8);
        $weightTarget = WeightTarget::where('user_id', $user->id)->first();

        return view('weight_logs.index', compact('weightLogs', 'weightTarget'));
    }

    // 体重登録画面（モーダル表示）
    public function create()
    {
        return view('weight_logs.create');
    }

    // 登録処理
    public function store(StoreWeightLogRequest $request)
    {
        $user = Auth::user();
        WeightLog::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index');
    }

    // 検索機能
    public function search(Request $request)
    {
        $user = Auth::user();
        $query = WeightLog::where('user_id', $user->id);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(8);

        return view('weight_logs.index', compact('weightLogs'));
    }

    // 体重詳細
    public function show($id)
    {
        $log = WeightLog::findOrFail($id);
        return view('weight_logs.show', compact('log'));
    }

    // 編集画面
    public function edit($id)
    {
        $log = WeightLog::findOrFail($id);
        return view('weight_logs.edit', compact('log'));
    }

    // 更新処理
    public function update(UpdateWeightLogRequest $request, $id)
    {
        $log = WeightLog::findOrFail($id);
        $log->update($request->validated());

        return redirect()->route('weight_logs.index');
    }

    // 削除処理
    public function destroy($id)
    {
        $log = WeightLog::findOrFail($id);
        $log->delete();

        return redirect()->route('weight_logs.index');
    }

    // 目標体重変更画面
    public function editGoal()
    {
        $goal = WeightTarget::where('user_id', Auth::id())->first();
        return view('weight_logs.goal_setting', compact('goal'));
    }

    // 目標体重更新処理
    public function updateGoal(UpdateGoalRequest $request)
    {
        $goal = WeightTarget::where('user_id', Auth::id())->first();
        $goal->update($request->validated());

        return redirect()->route('weight_logs.index');
    }
}
