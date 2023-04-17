<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Setting;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(Request $request){

        return view("setting");
    }


    public function update(SettingsUpdateRequest $request){
        $data = $request->validated();

        $user = Auth::user();

        $user->setting->update($data);

        return Response('',204);
    }

    public function show(Request $request){

        $user = Auth::user();

        $setting = $user->setting;
        return $setting;
    }


}
