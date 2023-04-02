<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'word_id',
        'user_level_id',
        'question_mode',
        'answer_count',
        'correct_progress',
        'vocabulary_lap'
    ];
}
