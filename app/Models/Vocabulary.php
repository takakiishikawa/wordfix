<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'word_idiom',
        'definition_en',
        'definition_jp',
        'frequency',
        'parse',
        'pronunciation',
        'word_root',
        'usage_notes',
        'prefix_en',
        'prefix_jp',
        'suffix_en',
        'suffix_jp',
        'suffix_parse',
        'image',
        'main_example_sentence',
        'extra_example_sentences'
    ];
}
