<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PastFixed;


class PastFixedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PastFixed::create([
            'type_id'=>1,
            'count'=>10,
            'user_id'=>1,
        ]);
        PastFixed::create([
            'type_id'=>2,
            'count'=>10,
            'user_id'=>1,
        ]);
    }
}
