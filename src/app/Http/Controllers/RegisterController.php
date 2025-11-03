<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // 会員登録画面（STEP1）
    public function showStep1()
    {
        return view('auth.register');
    }

    // 会員情報登録（STEP1）
    public function registerUser(RegisterUserRequest $request)
    {
        // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 作成後に自動ログイン
        Auth::login($user);

        // STEP2の初期体重登録画面へ
        return redirect()->route('register.step2');
    }

    // 初期体重登録画面（STEP2）
    public function showStep2()
    {
        return view('register.step2'); // step2用ビュー
    }

    // 初期体重・目標体重登録（STEP2）
    public function storeInitialWeight(RegisterStep2Request $request)
    {
        // ログイン中のユーザーIDを取得
        $userId = Auth::id();

        // 初期体重を登録
        WeightLog::create([
            'user_id' => $userId,
            'date' => now(),
            'weight' => $request->current_weight,
        ]);

        // 目標体重を登録
        WeightTarget::create([
            'user_id' => $userId,
            'target_weight' => $request->target_weight,
        ]);

        // 登録後は体重管理画面へ遷移
        return redirect()->route('weight_logs.index');
    }
}
