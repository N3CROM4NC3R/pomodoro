<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pomodoro>
 */
class PomodoroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $user = User::factory()->create();

        return [
            "focus_time" => $this->faker->numberBetween(1,30),
            "user_id" => $user->id
        ];
    }
}
