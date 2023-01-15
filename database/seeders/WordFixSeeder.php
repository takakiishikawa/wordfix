<?php

namespace Database\Seeders;
use App\Models\WordFix;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordFixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WordFix::create([
            'eng'=>'express',
            'jpn1'=>'表現する',
            'fix_id'=>1,
            'correctCount'=>0,
            'type_id'=>1,
            'parse_id'=>3,
            'user_id'=>1,
        ]);
        WordFix::create([
            'eng'=>'ancestor',
            'jpn1'=>'先祖',
            'fix_id'=>1,
            'correctCount'=>0,
            'type_id'=>1,
            'parse_id'=>1,
            'user_id'=>1,
        ]);
        WordFix::create([
            'eng'=>'bit',
            'jpn1'=>'少しの',
            'fix_id'=>1,
            'correctCount'=>0,
            'type_id'=>1,
            'parse_id'=>1,
            'user_id'=>1,
        ]);
        WordFix::create([
            'eng'=>'past',
            'jpn1'=>'過去の',
            'jpn2'=>'過去',
            'fix_id'=>2,
            'correctCount'=>0,
            'type_id'=>1,
            'parse_id'=>4,
            'user_id'=>1,
        ]);
        WordFix::create([
            'eng'=>'least',
            'jpn1'=>'ついに',
            'fix_id'=>2,
            'correctCount'=>0,
            'type_id'=>1,
            'parse_id'=>4,
            'user_id'=>1,
        ]);

    }
}







