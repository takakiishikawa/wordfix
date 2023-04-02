<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.p
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            'Beginner',
            'Elementary',
            'Pre-Intermediate',
            'Intermediate',
            'Upper-Intermediate',
            'Advanced'
        ];

        $idiomLevels = [
            'Basic',
            'Advanced'
        ];

        $subLevels = 10;

        // word of seed data
        foreach ($levels as $level) {
            for ($i = 1; $i <= $subLevels; $i++) {
                \DB::table('levels')->insert([
                    'level' => $level,
                    'sub_level' => $level . ' Level' . $i,
                    'word_idiom' => 'word'
                ]);
            }
        }

        // idiom of seed data
        foreach ($idiomLevels as $level) {
            for ($i = 1; $i <= $subLevels; $i++) {
                \DB::table('levels')->insert([
                    'level' => $level,
                    'sub_level' => $level . ' Level' . $i,
                    'word_idiom' => 'idiom'
                ]);
            }
        }
    }
}
