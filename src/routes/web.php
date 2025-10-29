<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;

// ----------------------------
// 会員登録画面
// ----------------------------
Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'registerUser'])->name('register.step1.post');

Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'storeInitialWeight'])->name('register.step2.post');

// ----------------------------
// ログイン / ログアウト
// ----------------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------------------
// 体重管理画面
// ----------------------------
Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

// 体重登録
Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
Route::post('/weight_logs/create', [WeightLogController::class, 'store'])->name('weight_logs.store');

// 体重検索
Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

// 体重詳細
Route::get('/weight_logs/{id}', [WeightLogController::class, 'show'])->name('weight_logs.show');

// 体重更新
Route::get('/weight_logs/{id}/update', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
Route::post('/weight_logs/{id}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');

// 体重削除
Route::delete('/weight_logs/{id}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

// 目標体重変更
Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'editGoal'])->name('weight_logs.goal_edit');
Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'updateGoal'])->name('weight_logs.goal_update');
