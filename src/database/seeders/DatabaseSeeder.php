<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ユーザー1件作成（既に存在する場合は再作成しない）
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. WeightTarget 1件作成（ユーザーに紐付け）
        WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);

        // 3. WeightLog 35件作成（ユーザーに紐付け）
        WeightLog::factory(35)->create([
            'user_id' => $user->id,
        ]);
    }
}
