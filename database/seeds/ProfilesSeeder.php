<?php

use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Profile::create([
        	'nickname' => 'Sponsor 1',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 1,
        ]);
        \App\Profile::create([
        	'nickname' => 'Sponsor 2',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 2,
        ]);

        \App\Profile::create([
        	'nickname' => 'Volunteer 1',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 3,
        ]);

        \App\Profile::create([
        	'nickname' => 'Volunteer 2',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 4,
        ]);

        \App\Profile::create([
        	'nickname' => 'Volunteer 3',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 5,
        ]);

        \App\Profile::create([
        	'nickname' => 'Volunteer 4',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 6,
        ]);

        \App\Profile::create([
        	'nickname' => 'Volunteer 5',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 7,
        ]);

        \App\Profile::create([
        	'nickname' => 'Volunteer 6',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 8,
        ]);

        \App\Profile::create([
        	'nickname' => 'Volunteer 7',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 9,
        ]);

        \App\Profile::create([
        	'nickname' => 'Volunteer 8',
        	'image' => '/img/pr_default.jpg',
        	'description' => "Hasn't done shit",
        	'user_id' => 10,
        ]);
    }
}
