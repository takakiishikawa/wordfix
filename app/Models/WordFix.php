<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordFix extends Model
{
    use HasFactory;

    protected $fillable = [
        'eng',
        'jpn',
        'correctCount',
        'type_id',
        'parse_id',
        'fix_id',
        'user_id',
        'sentence',
        'suffix_id',
        'root_id',
        'prefix_id',
        'origin_id',
        'word_origin_id',
    ];
}
