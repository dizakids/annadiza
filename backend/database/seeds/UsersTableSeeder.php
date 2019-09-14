<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'sk',
            'email' => 'sample@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'gender' => 'w',
            'age' => 30,
            'post_code' => '53003',
            'prefecture_code' => 9,
            'address'=> 'Kiev',
            'admin' => true,
        ]);
    }
}
