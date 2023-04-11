<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pomodoro>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $user = User::factory()->create();

        $faker = Faker::create();
        return [
            "color"=> $faker->hexColor(),
            "focus_time"=> $faker->numberBetween(1,50),
            "long_break_time"=> $faker->numberBetween(5,15),
            "break_time"=> $faker->numberBetween(1,5),
            "pomodoro_count"=> $faker->numberBetween(1,8),
            "user_id" => $user->id
        ];
    }
}
