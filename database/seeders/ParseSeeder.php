<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parse;


class ParseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parse::create([
            'parse'=>'n',
        ]);
        Parse::create([
            'parse'=>'pron',
        ]);
        Parse::create([
            'parse'=>'v',
        ]);
        Parse::create([
            'parse'=>'adj',
        ]);
        Parse::create([
            'parse'=>'adv',
        ]);
        Parse::create([
            'parse'=>'aux',
        ]);
        Parse::create([
            'parse'=>'prep',
        ]);
        Parse::create([
            'parse'=>'art',
        ]);
        Parse::create([
            'parse'=>'con',
        ]);
        Parse::create([
            'parse'=>'int',
        ]);
    }
}
