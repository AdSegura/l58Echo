<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "superman",
            'email' => "superman@local.host",
            'password' => bcrypt('1234'),
        ]);

        DB::table('users')->insert([
            'name' => "superwoman",
            'email' => "superwoman@local.host",
            'password' => bcrypt('1234'),
        ]);
    }
}
