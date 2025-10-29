<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightTarget;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeightTarget>
 */
class WeightTargetFactory extends Factory
{
    protected $model = WeightTarget::class;

    public function definition(): array
    {
        return [
            'user_id' => 1, // 実際にはSeederで上書き
            'target_weight' => $this->faker->randomFloat(1, 40, 80), // 目標体重 40.0～80.0kg
            'target_date' => $this->faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
        ];
    }
}
