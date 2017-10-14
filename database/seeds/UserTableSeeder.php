<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = array(
            'name' => 'hogehoge',
            'email' => 'xyz@gmail.com',
            'password' => Hash::make('admin'),
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        DB::table('users')->insert($user);
    }
}
