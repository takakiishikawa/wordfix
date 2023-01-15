<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fix;


class FixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fix::create([
            'fix'=>'fixed',
        ]);
        Fix::create([
            'fix'=>'unfixed',
        ]);
    }
}
