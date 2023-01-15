<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerCount extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'word_fix_id',
        'correct',
        'type_id',
    ];
}
