<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pomodoro;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PomodoroController extends Controller
{
    public function index(Request $request){

        return view("pomodoro");
    }


    public function update(Request $request){
        $data = $request->all();

        $user = Auth::user();

        $user->pomodoro->update($data);

        return Response('',204);
    }

    public function show(Request $request){

        $user = Auth::user();

        $pomodoro = $user->pomodoro;
        return $pomodoro;
    }


}
