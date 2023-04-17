<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


use Tests\TestCase;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SettingTest extends TestCase
{
    use RefreshDatabase;


    private function login(){
        $user = User::factory()->create();

        Auth::login($user);
        return $user;
    }

    public function test_setting_factory(): void
    {
        $setting = Setting::factory()->create();

        $this->assertDatabaseHas('settings',[
            "color" => $setting->color,
            "focus_time" => $setting->focus_time,
            "long_break_time" => $setting->long_break_time,
            "break_time" => $setting->break_time,
            "pomodoro_count" => $setting->pomodoro_count,
            "user_id" => $setting->user->id
        ]);
    }


    public function test_user_can_save_setting(){

        $user = $this->login();

        $setting = Setting::factory()->create(["user_id" => $user->id]);

        $new_setting = Setting::factory()->raw();

        $data = [
            "color" => $new_setting["color"],
            "focus_time" => $new_setting["focus_time"],
            "long_break_time" => $new_setting["long_break_time"],
            "break_time" => $new_setting["break_time"],
            "pomodoro_count" => $new_setting["pomodoro_count"],
        ];

        $response = $this->putJson("setting", $data);

        $response->assertStatus(204);

        $this->assertDatabaseHas("settings",[
            "id" => $setting->id,
            "focus_time" => $new_setting["focus_time"],
            "long_break_time" => $new_setting["long_break_time"],
            "break_time" => $new_setting["break_time"],
            "pomodoro_count" => $new_setting["pomodoro_count"],
            "user_id" => $setting->user_id
            ]
        );
    }

    public function test_user_cant_save_setting_with_wrong_data(){

        $user = $this->login();

        $setting = Setting::factory()->create(["user_id" => $user->id]);

        $new_setting = Setting::factory()->raw();

        $data = [
            "color" => "This is a test",
            "focus_time" => "This is a test",
            "long_break_time" => "This is a test",
            "break_time" => "This is a test",
            "pomodoro_count" => "This is a test",
        ];

        $response = $this->putJson("setting", $data);

        $response->assertStatus(422);

        $this->assertDatabaseMissing("settings",[
            "id" => $data["color"],
            "focus_time" => $data["focus_time"],
            "long_break_time" => $data["long_break_time"],
            "break_time" => $data["break_time"],
            "pomodoro_count" => $data["pomodoro_count"],
            "user_id" => $setting->user_id
            ]
        );
    }


    public function test_user_can_request_setting(){
        $user = $this->login();

        $setting = Setting::factory()->create(["user_id" => $user->id]);
        $response = $this->getJson("setting");
        $response->assertStatus(200);
        $response->assertJsonFragment([
            "color" => $setting->color,
            "focus_time" => $setting->focus_time,
            "long_break_time" => $setting->long_break_time,
            "break_time" => $setting->break_time,
            "pomodoro_count" => $setting->pomodoro_count,

        ]);

        $response->assertJsonFragment([
            "user_id" => $user->id
        ]);
    }

    public function test_guest_cant_save_setting(){

        $setting = Setting::factory()->create();

        $new_setting = Setting::factory()->raw();

        $data = [
            "color" => $new_setting["color"],
            "focus_time" => $new_setting["focus_time"],
            "long_break_time" => $new_setting["long_break_time"],
            "break_time" => $new_setting["break_time"],
            "pomodoro_count" => $new_setting["pomodoro_count"],
            "user_id" => $new_setting["user_id"]
        ];


        $response = $this->putJson("setting", $data);

        $response->assertStatus(401);

        $this->assertDatabaseMissing("settings",[
            "id" => $setting->id,
            "focus_time" => $new_setting["focus_time"],
            "long_break_time" => $new_setting["long_break_time"],
            "break_time" => $new_setting["break_time"],
            "pomodoro_count" => $new_setting["pomodoro_count"],
            "user_id" => $setting->user_id
            ]
        );
    }


    public function test_guest_cant_request_setting(){

        $setting = Setting::factory()->create();

        $response = $this->getJson("setting");

        $response->assertStatus(401);

    }



}
