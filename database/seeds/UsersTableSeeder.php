<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'    => 'Admin',
            'email'    =>  'tokoproyek@gmail.com',
            'password' =>Hash::make('admin2021'),
    ]);
        \App\User::create([
            'name'    => 'Admin2 ',
            'email'    =>  'repaldi25@gmail.com',
            'password' =>Hash::make('admin2021'),
    ]);
    }
}
