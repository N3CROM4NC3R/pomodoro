<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_registered_user_has_a_record_in_pomodoro_table(): void
    {
        $user = User::factory()->raw();

        $data = [
            "name" => $user["name"],
            "email" => $user["email"],
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $response = $this->post("/register",$data);
        $response->assertStatus(302);

        $user = User::all()->first();

        $this->assertDatabaseHas('pomodoros', [
            "focus_time" => 25,
            "long_break_time" => 15,
            "break_time" => 5,
            "pomodoro_count" => 4,
            'user_id' => 1,
        ]);
    }
}
