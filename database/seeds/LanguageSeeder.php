<?php

use Illuminate\Database\Seeder;
use App\LanguageLevel;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LanguageLevel::insert([
            [
                'name' => 'Intermediate (B1)',
                'code' => 'intermediate'
            ],
            [
                'name' => 'Advanced',
                'code' => 'advanced'
            ],
            [
                'name' => 'Proficient/Fluent (C2)',
                'code' => 'fluent'
            ],
            [
                'name' => 'Native or bilingual',
                'code' => 'native'
            ]
        ]);
    }
}
