<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PomodoroController;
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
    Route::put("/pomodoro",[PomodoroController::class, "update"]);
    Route::get("/pomodoro",[PomodoroController::class, "show"]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
