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
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@domain.com',
            'password' => app('hash')->make('pass', []),
            'is_admin' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@domain.com',
            'password' => app('hash')->make('pass', []),
        ]);

        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@domain.com',
            'password' => app('hash')->make('pass', []),
        ]);
    }
}
