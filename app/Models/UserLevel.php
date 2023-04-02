<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level_id',
        'question_mode',
        'level_question_count',
        'level_status',
        'level_lap'
    ];
}
