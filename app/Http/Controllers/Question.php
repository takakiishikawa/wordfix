<?php

namespace App\Http\Controllers;
use App\Models\WordFix;
use App\Models\PastFixed;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Parse;
use App\Models\Root;
use App\Models\Prefix;
use App\Models\Suffix;

use App\Models\Fix;
use App\Models\WordOrigin;

use App\Models\AnswerCount;


use App\Http\Controllers\Auth;
use Carbon\Carbon;


class Question extends Controller
{
    function questionList(){

        $wordQuestionList=[1,2,3];

        return response()->json([
            'wordQuestionList'=>$wordQuestionList,
        ]);
    }


}
