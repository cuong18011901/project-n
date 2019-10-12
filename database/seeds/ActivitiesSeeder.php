<?php

use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 16 ; $i++) { 
            \App\Activity::create([
                'title' => 'Activity ' . $i,
                'description' => 'A seeded activity for the sake of seeding, means no shit.',
                'lat' => (16.047079 + $i/100),
                'lng' => (108.206230 + $i/100),
                'start' => date('Y-m-d'),
                'status' => 'on going',
                'budget' => $i * 1000000,
                'sponsor_id' => ($i % 2 === 0) ? 2 : 1,
                'concern' => 8,
                'image' => '/img/default.jpg'
            ])->volunteers()->attach([1,2,3,4,5,6,7,8]);
        }

        foreach (\App\Activity::all() as $act) {
            $act->tags()->attach([1,2,3]);
        }
    }
}
