<?php

use Cerebox\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Admin',
        	'email' => 'admin@email.com',
        	'nickname' => 'Admin',
        	'phone' => '(00)0000-0000',
            'admin' => 1
        	'city_id' => 1100023
    	]);

    	$user->password = \Hash::make('1234');

    	$user->save();
    }
}
