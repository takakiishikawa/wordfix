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
        $wordUnfixedList=WordFix::where('fix_id',2)->where('type_id',1)->inRandomOrder()->take(10)->get();
        $idiomUnfixedList=WordFix::where('fix_id',2)->where('type_id',2)->inRandomOrder()->take(10)->get();

        //word
        //obj → ary
        $wordUnfixedArray=[];
        foreach ($wordUnfixedList as $wordUnfixedRecord){
            $wordUnfixedArray[]=$wordUnfixedRecord;
        }

        //obj to ary
        $wordQuestionList=[];
        for($i=0; $i < count($wordUnfixedArray);$i++){
                $parseRecord=Parse::where('id',$wordUnfixedArray[$i]->parse_id)->first();
                $parse=$parseRecord->parse;

                if($wordUnfixedArray[$i]->root_id==null){
                    $root=null;
                }else{
                    $rootRecord=Root::where('id',$wordUnfixedArray[$i]->root_id)->first();
                    $root=$rootRecord->root;
                }

                $wordQuestionList[]=array(
                    'id'=>$wordUnfixedArray[$i]->id,
                    'eng'=>$wordUnfixedArray[$i]->eng,
                    'correctCount'=>$wordUnfixedArray[$i]->correctCount,
                    'jpn'=>$wordUnfixedArray[$i]->jpn,
                    'parse'=>$parse,
                    'sentence'=>$wordUnfixedArray[$i]->sentence,
                    'root'=>$root,
                );
        }

        //idiom
        //obj → ary
        $idiomUnfixedArray=[];
        foreach ($idiomUnfixedList as $idiomUnfixedRecord){
            $idiomUnfixedArray[]=$idiomUnfixedRecord;
        }

        //obj to ary
        $idiomQuestionList=[];
        for($i=0; $i < count($idiomUnfixedArray);$i++){
                $parseRecord=Parse::where('id',$idiomUnfixedArray[$i]->parse_id)->first();
                $parse=$parseRecord->parse;

                $idiomQuestionList[]=array(
                    'id'=>$idiomUnfixedArray[$i]->id,
                    'eng'=>$idiomUnfixedArray[$i]->eng,
                    'correctCount'=>$idiomUnfixedArray[$i]->correctCount,
                    'jpn'=>$idiomUnfixedArray[$i]->jpn,
                    'parse'=>$parse,
                    'sentence'=>$idiomUnfixedArray[$i]->sentence,
                    'root'=>$root,
                );
        }

        return response()->json([
            'wordQuestionList'=>$wordQuestionList,
            'idiomQuestionList'=>$idiomQuestionList,
        ]);
    }

    function answerList(){
        $json = file_get_contents("php://input");
        $answerList = json_decode($json,true);
        \Log::debug('[QuestionController,answerList]',$answerList);

        foreach($answerList as $answerRecord){
            $unfixedRecord=WordFix::where('id',$answerRecord['id'])->first();
            if(str_contains($unfixedRecord->jpn,$answerRecord['answer']) && $answerRecord['answer']!==""){
                $unfixedRecord->correctCount++;

                $type_id=$unfixedRecord->type_id;
                AnswerCount::create([
                    'user_id'=>1,
                    'word_fix_id'=>$answerRecord['id'],
                    'correct'=>1,
                    'type_id'=>$type_id,
                ]);
            }
            else{
                $unfixedRecord->correctCount=0;

                $type_id=$unfixedRecord->type_id;
                AnswerCount::create([
                    'user_id'=>1,
                    'word_fix_id'=>$answerRecord['id'],
                    'correct'=>0,
                    'type_id'=>$type_id,
                ]);
            }
            if($unfixedRecord->correctCount===3){
                $unfixedRecord->fix_id=1;
            }
            $unfixedRecord->save();
        }


        return response()->json();
    }

}
