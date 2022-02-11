<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'vandarymannis0@gmail.com',
            'password'=>bcrypt('12345678'),
            'user_type'=>'admin'
        ]);
    }
}
