<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Question;
use App\Http\Controllers\Add;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top');
});

//リロード時のredirect
Route::get('/idiom', function () {
    return redirect('');
});
Route::get('/add', function () {
    return redirect('');
});
Route::get('/list', function () {
    return redirect('');
});


//API
Route::get('/fixList',[Question::class,'fixList']);
Route::get('/api',[Question::class,'index']);
Route::get('/wordFixedCount',[Question::class,'wordFixedCount']);
Route::get('/questionList',[Question::class,'questionList']);
Route::post('/answerList',[Question::class,'answerList']);

Route::post('/add/pastFixed',[Add::class,'addPastFixed']);
Route::post('/add/newWord',[Add::class,'addNewWord']);

Route::get('/add/select',[Add::class,'select']);

