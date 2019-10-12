<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(ProfilesSeeder::class);
        $this->call(VolunteersSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(ActivitiesSeeder::class);
        $this->call(SponsorsSeeder::class);
        $this->call(CommentsSeeder::class);
    }
}
