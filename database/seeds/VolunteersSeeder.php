<?php

use Illuminate\Database\Seeder;

class VolunteersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Volunteer::create([
        	'user_id' => 3,
        ]);

        \App\Volunteer::create([
            'user_id' => 4,
        ]);
        \App\Volunteer::create([
            'user_id' => 5,
        ]);
        \App\Volunteer::create([
            'user_id' => 6,
        ]);

        \App\Volunteer::create([
            'user_id' => 7,
        ]);

        \App\Volunteer::create([
            'user_id' => 8,
        ]);
        \App\Volunteer::create([
            'user_id' => 9,
        ]);
        \App\Volunteer::create([
            'user_id' => 10,
        ]);
    }
}
