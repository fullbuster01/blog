<?php

use App\User;
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
        $valentin = User::create([
            'name' => 'valentin',
            'username' => 'valentin',
            'email' => 'caca@role.co',
            'password' => bcrypt('password')
        ]);

        $anjani = User::create([
            'name' => 'anjani',
            'username' => 'anjani',
            'email' => 'anjani@role.co',
            'password' => bcrypt('password')
        ]);

        $sya = User::create([
            'name' => 'sya',
            'username' => 'sya',
            'email' => 'sya@role.co',
            'password' => bcrypt('password')
        ]);
    }
}
