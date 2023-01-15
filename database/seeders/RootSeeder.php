<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Root;


class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Root::create([
            'root'=>'sta',
            'jpn'=>'立つ',
        ]);
        Root::create([
            'root'=>'sist/stitu',
            'jpn'=>'立つ',
        ]);
        Root::create([
            'root'=>'fac',
            'jpn'=>'作る/行う',
        ]);
        Root::create([
            'root'=>'cap',
            'jpn'=>'取る/捕える',
        ]);
        Root::create([
            'root'=>'cap',
            'jpn'=>'頭/長',
        ]);
        Root::create([
            'root'=>'ply',
            'jpn'=>'祈る/重ねる/包む',
        ]);
        Root::create([
            'root'=>'vert',
            'jpn'=>'回る/向ける',
        ]);
        Root::create([
            'root'=>'spect',
            'jpn'=>'見る',
        ]);
        Root::create([
            'root'=>'reg',
            'jpn'=>'統治する/正しい/王',
        ]);
        Root::create([
            'root'=>'pose',
            'jpn'=>'置く',
        ]);
        Root::create([
            'root'=>'cede',
            'jpn'=>'行く/屈服する/譲る',
        ]);
        Root::create([
            'root'=>'act',
            'jpn'=>'行う',
        ]);
        Root::create([
            'root'=>'tract',
            'jpn'=>'引く',
        ]);
        Root::create([
            'root'=>'sess',
            'jpn'=>'座る',
        ]);
        Root::create([
            'root'=>'tain',
            'jpn'=>'保つ',
        ]);
        Root::create([
            'root'=>'gen',
            'jpn'=>'生む/種族',
        ]);
        Root::create([
            'root'=>'tend',
            'jpn'=>'伸びる/伸ばす/張る',
        ]);
        Root::create([
            'root'=>'mit',
            'jpn'=>'送る/行かせる/投げる',
        ]);
        Root::create([
            'root'=>'pend',
            'jpn'=>'ぶら下がる/重さを量る/支払う',
        ]);
        Root::create([
            'root'=>'far',
            'jpn'=>'運ぶ/耐える/産む',
        ]);
        Root::create([
            'root'=>'cur',
            'jpn'=>'注意する/気を付ける/治療する',
        ]);
    }
}
