<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Questions_optionSeeder extends Seeder
{
    public function run()
    {
//        DB::table((new Questions_option)->getTable())->truncate();

        DB::table('questions_options')->insert([
            [
                'id'             => increments('id'),
                'question_id'    => 10,
                'option'         => 's1',
                'correct'        => 1,
                'category_name'  => 0,
                'item_difficulty'=> 1,
                'discrimination_power' => 0,
                'created_at'        => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'=> Carbon::now(),

            ],
        ]);


    }
}
