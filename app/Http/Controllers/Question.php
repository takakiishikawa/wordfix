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
    function fixList(){
        $fixedArray=WordFix::where('fix_id',1)->orderBy('created_at','desc')->get();
        $unfixedArray=WordFix::where('fix_id',2)->orderBy('created_at','desc')->get();

        $fixedList=[];
        for($i=0; $i < count($fixedArray);$i++){
            $typeRecord=Type::where('id',$fixedArray[$i]->type_id)->first();
            $type=$typeRecord->type;

            $parseRecord=Parse::where('id',$fixedArray[$i]->parse_id)->first();
            $parse=$parseRecord->parse;

            if($fixedArray[$i]->root_id==null){
                $root=null;
            }else{
                $rootRecord=Root::where('id',$fixedArray[$i]->root_id)->first();
                $root=$rootRecord->root;
            }

            if($fixedArray[$i]->suffix_id==null){
                $suffix=null;
            }else{
                $suffixRecord=Suffix::where('id',$fixedArray[$i]->suffix_id)->first();
                $suffix=$suffixRecord->root;
            }

            if($fixedArray[$i]->prefix_id==null){
                $prefix=null;
            }else{
                $prefixRecord=Prefix::where('id',$fixedArray[$i]->prefix_id)->first();
                $prefix=$prefixRecord->prefix;
            }

            if($fixedArray[$i]->origin_id==null){
                $origin=null;
            }else{
                $originRecord=WordFix::where('id',$fixedArray[$i]->origin_id)->first();
                $origin=$originRecord->eng;
            }

            if($fixedArray[$i]->word_origin_id==null){
                $wordOrigin=null;
            }else{
                $wordOriginRecord=WordOrigin::where('id',$fixedArray[$i]->word_origin_id)->first();
                $wordOrigin=$wordOriginRecord->word_origin;
            }

            $fixedList[]=array(
                'id'=>$fixedArray[$i]->id,
                'eng'=>$fixedArray[$i]->eng,
                'jpn'=>$fixedArray[$i]->jpn,
                'type'=>$type,
                'parse'=>$parse,
                'created_at'=>$fixedArray[$i]->created_at->format('y/m/d'),
                'root'=>$root,
                'prefix'=>$prefix,
                'suffix'=>$suffix,
                'sentence'=>$fixedArray[$i]->sentence,
                'origin'=>$origin,
                'wordOrigin'=>$wordOrigin,
            );
        }

        $unfixedList=[];
        for($i=0; $i < count($unfixedArray);$i++){
            $typeRecord=Type::where('id',$unfixedArray[$i]->type_id)->first();
            $type=$typeRecord->type;

            $parseRecord=Parse::where('id',$unfixedArray[$i]->parse_id)->first();
            $parse=$parseRecord->parse;

            if($unfixedArray[$i]->root_id==null){
                $root=null;
            }else{
                $rootRecord=Root::where('id',$unfixedArray[$i]->root_id)->first();
                \Log::debug('[Controller,root]',[$rootRecord]);
                $root=$rootRecord->root;
            }

            if($unfixedArray[$i]->suffix_id==null){
                $suffix=null;
            }else{
                $suffixRecord=Suffix::where('id',$unfixedArray[$i]->suffix_id)->first();
                $suffix=$suffixRecord->suffix;
            }

            if($unfixedArray[$i]->prefix_id==null){
                $prefix=null;
            }else{
                $prefixRecord=Prefix::where('id',$unfixedArray[$i]->prefix_id)->first();
                $prefix=$prefixRecord->prefix;
            }


            if($unfixedArray[$i]->origin_id==null){
                $origin=null;
            }else{
                $originRecord=WordFix::where('id',$unfixedArray[$i]->origin_id)->first();
                $origin=$originRecord->eng;
            }

            if($unfixedArray[$i]->word_origin_id==null){
                $wordOrigin=null;
            }else{
                $wordOriginRecord=WordOrigin::where('id',$unfixedArray[$i]->word_origin_id)->first();
                $wordOrigin=$wordOriginRecord->word_origin;
            }

            $unfixedList[]=array(
                'id'=>$unfixedArray[$i]->id,
                'eng'=>$unfixedArray[$i]->eng,
                'jpn'=>$unfixedArray[$i]->jpn,
                'type'=>$type,
                'parse'=>$parse,
                'created_at'=>$unfixedArray[$i]->created_at->format('y/m/d'),
                'root'=>$root,
                'prefix'=>$prefix,
                'suffix'=>$suffix,
                'sentence'=>$unfixedArray[$i]->sentence,
                'origin'=>$origin,
                'wordOrigin'=>$wordOrigin,

            );
        }
        \Log::debug('[Controller,確認！]',[$fixedList]);
        \Log::debug('[Controller,確認！]',[$unfixedList]);


        return response()->json(
            [
                'fixedList'=>$fixedList,
                'unfixedList'=>$unfixedList,
            ]
        );
    }

    function wordFixedCount(){
        $fixedRecord=Fix::where('fix','fixed')->first();
        $fixed_id=$fixedRecord->id;

        $unfixedRecord=Fix::where('fix','unfixed')->first();
        $unfixed_id=$unfixedRecord->id;


        //word
        $wordTypeRecord=Type::where('type','word')->first();
        $wordType_id=$wordTypeRecord->id;

        $wordCount=0;
        $wordList=PastFixed::where('type_id',$wordType_id)->get();
        foreach($wordList as $wordRecord){
            $wordCount=$wordCount+$wordRecord->count;
        }

        $wordFixed=WordFix::where('type_id',$wordType_id)->where('fix_id',$fixed_id)->get();
        $wordFixedCount=$wordFixed->count();

        //idiom
        $idiomTypeRecord=Type::where('type','idiom')->first();
        $idiomType_id=$idiomTypeRecord->id;

        $idiomCount=0;
        $idiomList=PastFixed::where('type_id',$idiomType_id)->get();
        foreach($idiomList as $idiomRecord){
            $idiomCount=$idiomCount+$idiomRecord->count;
        }

        $idiomFixed=WordFix::where('type_id',2)->where('fix_id',$fixed_id)->get();
        $idiomFixedCount=$idiomFixed->count();


        $wordTotalCount=$wordCount+$wordFixedCount;
        $idiomTotalCount=$idiomCount+$idiomFixedCount;

        //unfixedCount
        $unfixedRecord=Fix::where('fix','unfixed')->first();
        $unfixed_id=$unfixedRecord->id;

        $wordUnfixedList=WordFix::where('fix_id',$unfixed_id)->where('type_id',$wordType_id)->get();
        $wordUnfixedCount=$wordUnfixedList->count();

        $idiomUnfixedList=WordFix::where('fix_id',$unfixed_id)->where('type_id',$idiomType_id)->get();
        $idiomUnfixedCount=$idiomUnfixedList->count();

        //word回答数&正解数合計
        $wordTypeRecord=Type::where('type','word')->first();
        $wordTypeId=$wordTypeRecord->id;

        $wordAnswerCountList=AnswerCount::where('type_id',$wordTypeId)->get();
        $wordAnswerCountTotal=$wordAnswerCountList->count();

        $wordAnswerCountCorrectList=AnswerCount::where('correct',1)->where('type_id',$wordTypeId)->get();
        $wordAnswerCountCorrect=$wordAnswerCountCorrectList->count();

        //word so so
        $wordOneWeek=Carbon::today()->subDay(7);
        $wordOneWeekList=AnswerCount::whereDate('created_at', '>=', $wordOneWeek)->where('correct',1)->get();
        $wordOneWeekCount=$wordOneWeekList->count();

        $wordWeekState='';
        if($wordOneWeekCount<=99){
            $wordWeekState="so so";
        }elseif($wordOneWeekCount>=100 && $wordOneWeekCount<=199){
            $wordWeekState='good';
        }elseif($wordOneWeekCount>=100 && $wordOneWeekCount<=199){
            $wordWeekState='so good';
        }elseif($wordOneWeekCount>=100 && $wordOneWeekCount<=199){
            $wordWeekState='great';
        }

        //idiom回答数&正解数合計
        $idiomTypeRecord=Type::where('type','idiom')->first();
        $idiomTypeId=$idiomTypeRecord->id;

        $idiomAnswerCountList=AnswerCount::where('type_id',$idiomTypeId)->get();
        $idiomAnswerCountTotal=$idiomAnswerCountList->count();

        $idiomAnswerCountCorrectList=AnswerCount::where('correct',1)->where('type_id',$idiomTypeId)->get();
        $idiomAnswerCountCorrect=$idiomAnswerCountCorrectList->count();

        //idiom so so
        $idiomOneWeek=Carbon::today()->subDay(7);
        $idiomOneWeekList=AnswerCount::whereDate('created_at', '>=', $idiomOneWeek)->where('correct',1)->get();
        $idiomOneWeekCount=$idiomOneWeekList->count();

        $idiomWeekState='';
        if($idiomOneWeekCount<=99){
            $idiomWeekState="so so";
        }elseif($idiomOneWeekCount>=100 && $idiomOneWeekCount<=199){
            $idiomWeekState='good';
        }elseif($idiomOneWeekCount>=100 && $idiomOneWeekCount<=199){
            $idiomWeekState='so good';
        }elseif($idiomOneWeekCount>=100 && $idiomOneWeekCount<=199){
            $idiomWeekState='great';
        }

        return response()->json([
            'wordTotalCount'=>$wordTotalCount,
            'newWordFixedCount'=>$wordFixedCount,
            'idiomTotalCount'=>$idiomTotalCount,
            'newIdiomFixedCount'=>$idiomFixedCount,
            'idiomUnfixedCount'=>$idiomUnfixedCount,
            'wordUnfixedCount'=>$wordUnfixedCount,
            //回答数&正解数
            'wordAnswerCountTotal'=>$wordAnswerCountTotal,
            'wordAnswerCountCorrect'=>$wordAnswerCountCorrect,
            'idiomAnswerCountTotal'=>$idiomAnswerCountTotal,
            'idiomAnswerCountCorrect'=>$idiomAnswerCountCorrect,
            'wordWeekState'=>$wordWeekState,
            'idiomWeekState'=>$idiomWeekState,

        ]);
    }

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
