<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Comment::create([
        	'profile_id' => 1,
        	'activity_id' => 1,
        	'content' => 'Trust me this activity is da best in za warudo!!!',
        ]);

        \App\Comment::create([
        	'profile_id' => 2,
        	'activity_id' => 1,
        	'content' => 'Trust me this activity does no do shit!!!',
        ]);

        \App\Comment::create([
        	'profile_id' => 1,
        	'activity_id' => 2,
        	'content' => 'This one sounds gay...',
        ]);

        \App\Comment::create([
        	'profile_id' => 2,
        	'activity_id' => 2,
        	'content' => 'Agreed, cannot be gayer...',
        ]);
    }
}
