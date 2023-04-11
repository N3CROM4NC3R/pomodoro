<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            //the default focus time is 25 minutes
            $focus_time = 25;
            // The default long break time is 15 minutes
            $long_break_time = 15;
            // The default short break time is 5 minutes
            $break_time = 5;
            $pomodoro_count = 4;


            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign("user_id")->references("id")->on("users");
            $table->string("color", 7)->default("#FFFFFF");
            $table->integer("focus_time")->default($focus_time);
            $table->integer("long_break_time")->default($long_break_time);
            $table->integer("break_time")->default($break_time);
            $table->integer("pomodoro_count")->default($pomodoro_count);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pomodoros');
    }
};
