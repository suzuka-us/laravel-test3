<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeightLog>
 */
class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    public function definition(): array
    {
        return [
            'user_id' => 1, // Seederで上書き
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 40, 80), // 40.0～80.0kg
            'calories' => $this->faker->numberBetween(1500, 3000),
            'exercise_time' => $this->faker->time('H:i:s'),
            'exercise_content' => $this->faker->text(50),
        ];
    }
}
