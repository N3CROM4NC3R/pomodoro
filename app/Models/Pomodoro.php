<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pomodoro extends Model
{
    use HasFactory;

    protected $guarded = ["id","update_at","created_at"];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
