<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PastFixed;
use App\Models\WordFix;
use App\Models\Type;
use App\Models\Parse;
use App\Models\Fix;
use App\Models\Root;
use App\Models\Suffix;
use App\Models\Prefix;
use App\Models\WordOrigin;



use App\Http\Requests\AddAddNewWordRequest;


class Add extends Controller
{
    function addPastFixed(){
        $json = file_get_contents("php://input");
        $data = json_decode($json,true);
        \Log::debug('[AddController,fetchData]',[$data]);

        $typeRecord=Type::where('type',$data['type'])->first();
        $type_id=$typeRecord->id;

        PastFixed::create([
            'type_id'=>$type_id,
            'count'=>$data['count'],
            'countMemo'=>$data['countMemo'],
            'user_id'=>1,
        ]);

        return response()->json();
    }

    function addNewWord(AddAddNewWordRequest $Request){
        $json = file_get_contents("php://input");
        $data = json_decode($json,true);
        \Log::debug('[AddController,addNewWord]',[$data]);

        $typeRecord=Type::where('type',$data['type'])->first();
        $type_id=$typeRecord->id;

        $parseRecord=Parse::where('parse',$data['parse'])->first();
        $parse_id=$parseRecord->id;

        $fixRecord=Fix::where('fix','unfixed')->first();
        $fix_id=$fixRecord->id;

        if(!$data['root']==null){
            $rootRecord=Root::where('root',$data['root'])->first();
            $root_id=$rootRecord->id;
        }else{
            $root_id=null;
        }

        if(!$data['suffix']==null){
            $suffixRecord=Suffix::where('suffix',$data['suffix'])->first();
            $suffix_id=$suffixRecord->id;
        }else{
            $suffix_id=null;
        }

        if(!$data['prefix']==null){
            $prefixRecord=Prefix::where('prefix',$data['prefix'])->first();
            $prefix_id=$prefixRecord->id;
        }else{
            $prefix_id=null;
        }

        if(!$data['wordOrigin']==null){
            $wordOriginRecord=WordOrigin::where('word_origin',$data['wordOrigin'])->first();
            $wordOrigin_id=$wordOriginRecord->id;
        }else{
            $wordOrigin_id=null;
        }

        if(!$data['origin']==null){
            $wordFixRecord=WordFix::where('eng',$data['origin'])->first();
            $origin_id=$wordFixRecord->id;
        }else{
            $origin_id=null;
        }

        $eng=$data['eng'];
        $jpn=$data['jpn'];

        \Log::debug('[AddController,NewWord]',[$root_id,$suffix_id,$prefix_id]);

        WordFix::create([
            'type_id'=>$type_id,
            'parse_id'=>$parse_id,
            'eng'=>$eng,
            'jpn'=>$jpn,
            'fix_id'=>$fix_id,
            'correctCount'=>0,
            'user_id'=>1,
            'root_id'=>$root_id,
            'sentence'=>$data['sentence'],
            'prefix_id'=>$prefix_id,
            'suffix_id'=>$suffix_id,
            'origin_id'=>$origin_id,
            'wordOrigin_id'=>$wordOrigin_id,

        ]);

        return response()->json();
    }

    function select(){
        $suffixList=Suffix::all();
        $suffixArray=[];

        foreach($suffixList as $suffixRecord){
            $suffixArray[]=$suffixRecord->suffix;
        }

        $rootList=Root::all();
        $rootArray=[];

        foreach($rootList as $rootRecord){
            $rootArray[]=$rootRecord->root;
        }

        $prefixList=Prefix::all();
        $prefixArray=[];

        foreach($prefixList as $prefixRecord){
            $prefixArray[]=$prefixRecord->prefix;
        }

        $originList=WordFix::all();
        $originArray=[];
        foreach($originList as $originRecord){
            $originArray[]=$originRecord->eng;
        }

        $wordOriginList=WordOrigin::all();
        $wordOriginArray=[];

        foreach($wordOriginList as $wordOriginRecord){
            $wordOriginArray[]=$wordOriginRecord->word_origin;
        }



        \Log::debug('[AddController,select]',[$suffixArray]);

        return response()->json([
            'suffixArray'=>$suffixArray,
            'rootArray'=>$rootArray,
            'prefixArray'=>$prefixArray,
            'originArray'=>$originArray,
            'wordOriginArray'=>$wordOriginArray,
        ]);
    }
}
