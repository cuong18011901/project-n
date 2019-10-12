<?php

use Illuminate\Database\Seeder;

class SponsorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Sponsor::create([
        	'user_id' => 1,
        ]);

        \App\Sponsor::create([
            'user_id' => 2,
        ]);
    }
}
