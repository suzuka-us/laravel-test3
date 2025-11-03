<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\RegisterStep2Request; 
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
        // 修正② 表示するビューをstep2用に変更
        return view('register.step2'); 
    }

    // 初期体重・目標体重登録
    // 修正③ StoreWeightLogRequest → RegisterStep2Request に変更
    public function storeInitialWeight(RegisterStep2Request $request)
    {
        $userId = session('user_id');

        // 修正④ 初期体重と目標体重のみ登録
        WeightLog::create([
            'user_id' => $userId,
            'date' => now(),
            'weight' => $request->current_weight,
        ]);

        WeightTarget::create([
            'user_id' => $userId,
            'target_weight' => $request->target_weight,
        ]);

        // 登録後は体重管理画面へ遷移
        return redirect()->route('weight_logs.index');
    }
}
