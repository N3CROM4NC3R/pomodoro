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
        Schema::create('pomodoro', function (Blueprint $table) {
            //the default focus time is 25 minutes
            $focus_time = 25 * 60;
            // The default long break time is 15 minutes
            $long_break_time = 15 * 60;
            // The default short break time is 5 minutes
            $break_time = 5 * 60;
            $pomodoro_count = 4;


            $table->id();
            $table->string("color", 7)->default("#FFFFFF");
            $table->timestamp("focus_time")->default($focus_time);
            $table->timestamp("long_break_time")->default($long_break_time);
            $table->timestamp("break_time")->default($break_time);
            $table->integer("pomodoro_count")->default($pomodoro_count);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pomodoro');
    }
};
