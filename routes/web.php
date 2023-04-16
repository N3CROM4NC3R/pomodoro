<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pomodoro');
})->name("pomodoro");

Route::middleware(["auth","auth.session"])->group(function(){
    Route::put("/setting",[SettingController::class, "update"]);
    Route::get("/setting",[SettingController::class, "show"]);

    Route::get("/pomodoro/{mode}",[App\Http\Controllers\PomodoroController::class, 'index'])->whereAlpha("mode");
    Route::post("/pomodoro",[App\Http\Controllers\PomodoroController::class, 'create']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
