<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tag::create([
        	'name' => 'cleanning',
        ]);

        \App\Tag::create([
        	'name' => 'helping',
        ]);

        \App\Tag::create([
        	'name' => 'building',
        ]);
    }
}
