<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ログイン画面
    public function showLogin()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard')); // 修正
        }

        return back()->withErrors(['email' => '認証に失敗しました'])->withInput();
    }

    // ログアウト
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
