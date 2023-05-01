<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pomodoro;
use App\Http\Requests\PomodoroCreateRequest;

class PomodoroController extends Controller
{
    public function index(Request $request,$mode){

        switch($mode){
            case "daily":

                $pomodoros = Pomodoro::where("created_at",">=",today())->get();
                break;
            default:
                $pomodoros = [];
        }
        return $pomodoros;
    }


    public function create(PomodoroCreateRequest $request){
        $data = $request->validated();

        $user = auth()->user();

        $data["user_id"] = $user->id;

        $pomodoro = Pomodoro::create($data);


        return response('',200);
    }

    public function summary(Request $request, $mode){
        switch($mode){
            case "daily":

                $pomodoros = Pomodoro::where("created_at",">=",today())->get();

                $count = $pomodoros->count();
                $total_hours = 0;
                $pomodoros->map(function($pomodoro) use (&$total_hours){

                    $total_hours += $pomodoro->focus_time;
                });

                $data = [
                    "total_hours" => $total_hours,
                    "total_pomodoros" => $count
                ];

                break;
            default:
                $data = [];
        }
        return $data;
    }


}
