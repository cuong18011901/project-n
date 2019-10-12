<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
        	'name' => 'sponsor1',
        	'email' => 'sponsor1@mxh.com',
        	'type' => 1,
        	'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'name' => 'sponsor2',
            'email' => 'sponsor2@mxh.com',
            'type' => 1,
            'password' => bcrypt('123456'),
        ]);

        \App\User::create([
        	'name' => 'volunteer1',
        	'email' => 'volunteer1@mxh.com',
        	'type' => 2,
        	'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'name' => 'volunteer2',
            'email' => 'volunteer2@mxh.com',
            'type' => 2,
            'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'name' => 'volunteer3',
            'email' => 'volunteer3@mxh.com',
            'type' => 2,
            'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'name' => 'volunteer4',
            'email' => 'volunteer4@mxh.com',
            'type' => 2,
            'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'name' => 'volunteer5',
            'email' => 'volunteer5@mxh.com',
            'type' => 2,
            'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'name' => 'volunteer6',
            'email' => 'volunteer6@mxh.com',
            'type' => 2,
            'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'name' => 'volunteer7',
            'email' => 'volunteer7@mxh.com',
            'type' => 2,
            'password' => bcrypt('123456'),
        ]);

        \App\User::create([
            'name' => 'volunteer8',
            'email' => 'volunteer8@mxh.com',
            'type' => 2,
            'password' => bcrypt('123456'),
        ]);
    }
}
