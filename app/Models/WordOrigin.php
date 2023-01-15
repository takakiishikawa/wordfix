<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordOrigin extends Model
{
    use HasFactory;

    protected $fillable=[
        'word_origin',
        'jpn',
        'memo',
        'root_id',
    ];
}
