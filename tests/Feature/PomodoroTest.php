<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


use Tests\TestCase;
use App\Models\Pomodoro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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

        $this->assertDatabaseHas('pomodoros',[
            "color" => $pomodoro->color,
            "focus_time" => $pomodoro->focus_time,
            "long_break_time" => $pomodoro->long_break_time,
            "break_time" => $pomodoro->break_time,
            "pomodoro_count" => $pomodoro->pomodoro_count,
            "user_id" => $pomodoro->user->id
        ]);
    }


    public function test_user_can_save_pomodoro_configuration(){

        $user = $this->login();

        $pomodoro = Pomodoro::factory()->create(["user_id" => $user->id]);

        $new_pomodoro = Pomodoro::factory()->raw();

        $data = [
            "color" => $new_pomodoro["color"],
            "focus_time" => $new_pomodoro["focus_time"],
            "long_break_time" => $new_pomodoro["long_break_time"],
            "break_time" => $new_pomodoro["break_time"],
            "pomodoro_count" => $new_pomodoro["pomodoro_count"],
        ];

        $response = $this->putJson("pomodoro", $data);

        $response->assertStatus(204);

        $this->assertDatabaseHas("pomodoros",[
            "id" => $pomodoro->id,
            "focus_time" => $new_pomodoro["focus_time"],
            "long_break_time" => $new_pomodoro["long_break_time"],
            "break_time" => $new_pomodoro["break_time"],
            "pomodoro_count" => $new_pomodoro["pomodoro_count"],
            "user_id" => $pomodoro->user_id
            ]
        );
    }


    public function test_user_can_request_pomodoro_configuration(){
        $user = $this->login();

        $pomodoro = Pomodoro::factory()->create(["user_id" => $user->id]);
        $response = $this->getJson("pomodoro");
        $response->assertStatus(200);
        $response->assertJsonFragment([
            "color" => $pomodoro->color,
            "focus_time" => $pomodoro->focus_time,
            "long_break_time" => $pomodoro->long_break_time,
            "break_time" => $pomodoro->break_time,
            "pomodoro_count" => $pomodoro->pomodoro_count,

        ]);

        $response->assertJsonFragment([
            "user_id" => $user->id
        ]);
    }

    public function test_guest_cant_save_pomodoro_configuration(){

        $pomodoro = Pomodoro::factory()->create();

        $new_pomodoro = Pomodoro::factory()->raw();

        $data = [
            "color" => $new_pomodoro["color"],
            "focus_time" => $new_pomodoro["focus_time"],
            "long_break_time" => $new_pomodoro["long_break_time"],
            "break_time" => $new_pomodoro["break_time"],
            "pomodoro_count" => $new_pomodoro["pomodoro_count"],
            "user_id" => $new_pomodoro["user_id"]
        ];


        $response = $this->putJson("pomodoro", $data);

        $response->assertStatus(401);

        $this->assertDatabaseMissing("pomodoros",[
            "id" => $pomodoro->id,
            "focus_time" => $new_pomodoro["focus_time"],
            "long_break_time" => $new_pomodoro["long_break_time"],
            "break_time" => $new_pomodoro["break_time"],
            "pomodoro_count" => $new_pomodoro["pomodoro_count"],
            "user_id" => $pomodoro->user_id
            ]
        );
    }


    public function test_guest_cant_request_pomodoro_configuration(){

        $pomodoro = Pomodoro::factory()->create();

        $response = $this->getJson("pomodoro");

        $response->assertStatus(401);

    }



}
