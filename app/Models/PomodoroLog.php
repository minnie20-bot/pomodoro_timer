<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PomodoroLog extends Model
{
    protected $fillable = ['duration', 'status'];
}
