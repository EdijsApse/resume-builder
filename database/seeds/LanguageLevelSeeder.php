<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguageLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::insert([
            [
                'name' => 'Latvian',
                'code' => 'lv'
            ],
            [
                'name' => 'English',
                'code' => 'eng'
            ],
            [
                'name' => 'Mandarin',
                'code' => 'mnd'
            ]
        ]);
    }
}
