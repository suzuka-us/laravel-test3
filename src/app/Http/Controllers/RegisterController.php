<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\StoreWeightLogRequest;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 会員登録画面
    public function showStep1()
    {
        return view('auth.register');
    }

    // 会員情報登録
    public function registerUser(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録後は初期体重登録画面へ
        return redirect()->route('register.step2')->with('user_id', $user->id);
    }

    // 初期体重登録画面
    public function showStep2()
    {
        return view('weight_logs.create');
    }

    // 初期体重・目標体重登録
    public function storeInitialWeight(StoreWeightLogRequest $request)
    {
        $userId = session('user_id');

        WeightLog::create([
            'user_id' => $userId,
            'date' => now(),
            'weight' => $request->weight,
            'calories' => $request->calories ?? 0,
            'exercise_time' => $request->exercise_time ?? '00:00',
            'exercise_content' => $request->exercise_content ?? '',
        ]);

        WeightTarget::create([
            'user_id' => $userId,
            'target_weight' => $request->target_weight,
            'target_date' => $request->target_date,
        ]);

        return redirect()->route('weight_logs.index');
    }
}
