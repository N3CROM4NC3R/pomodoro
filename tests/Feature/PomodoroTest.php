<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Pomodoro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PomodoroTest extends TestCase
{

    use RefreshDatabase;


    private function login(){
        $user = User::factory()->create();

        Auth::login($user);
        return $user;
    }

    public function test_pomodoro_factory(): void
    {
        $pomodoro = Pomodoro::factory()->create();

        $this->assertTrue(is_integer($pomodoro->focus_time));
    }


    public function test_user_can_save_pomodoro(): void
    {
        $user = $this->login();

        $pomodoro = Pomodoro::factory()->raw();

        $response = $this->postJson("/pomodoro", $pomodoro);

        $response->assertStatus(200);

        $this->assertDatabaseHas("pomodoros", [
            "focus_time" => $pomodoro["focus_time"],
            "user_id" => $user->id
        ]);
    }


    public function test_user_cant_save_pomodoro_with_other_user_id(): void
    {
        $user = $this->login();

        $pomodoro = Pomodoro::factory()->raw(["user_id" => 65]);

        $response = $this->postJson("/pomodoro", $pomodoro);

        $response->assertStatus(200);

        $this->assertDatabaseHas("pomodoros", [
            "focus_time" => $pomodoro["focus_time"],
            "user_id" => $user->id
        ]);
    }

    public function test_user_cant_save_pomodoro_with_wrong_data_type(): void{
        $user = $this->login();

        $pomodoro = Pomodoro::factory()->raw(["focus_time" => "This is a test"]);

        $response = $this->postJson("/pomodoro", $pomodoro);

        $response->assertStatus(422);

        $this->assertDatabaseMissing("pomodoros", [
            "focus_time" => $pomodoro["focus_time"]
        ]);
    }

    public function test_guest_cant_save_pomodoro(){
        $pomodoro = Pomodoro::factory()->raw();

        $response = $this->postJson("/pomodoro", $pomodoro);

        $response->assertStatus(401);

        $this->assertDatabaseMissing("pomodoros", $pomodoro);

    }

    public function test_user_can_get_pomodoros_daily(){

        $user = $this->login();
        $pomodoro = Pomodoro::factory()->create(
            ["user_id" => $user->id]
        );

        $response = $this->getJson("/pomodoro/daily");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "focus_time" => $pomodoro->focus_time
        ]);
    }


    public function test_guest_cant_get_pomodoros_daily(){

        $pomodoro = Pomodoro::factory()->create();

        $response = $this->getJson("/pomodoro/daily");

        $response->assertStatus(401);

    }


    public function test_user_can_get_summary_daily(){
        $user = $this->login();

        $pomodoro = Pomodoro::factory()->create(
            ["user_id" => $user->id]
        );

        $response = $this->getJson("/summary/daily");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "total_hours" => $pomodoro->focus_time,
            "total_pomodoros" => 1,
        ]);

    }

    public function test_guest_cant_get_summary_daily(){
        $pomodoro = Pomodoro::factory()->create();

        $response = $this->getJson("/summary/daily");

        $response->assertStatus(401);

    }

}
