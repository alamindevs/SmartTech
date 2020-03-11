<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
        	[	
        		'name' => 'MD.Al-Amin Hawladar',
        		'email' => 'alamingeneral455@gmail.com',
        		'username' => 'mdalamin',
        		'phone' => '0172415312',
        		'address' => 'Mirpur-14',
        		'image' => Null,
        		'email_verified_at' => Carbon::now()->toDateTimeString(),
        		'password' => Hash::make('12345678'),
        	],[
        		'name' => 'MD.Al-Amin',
        		'email' => 'alamin@gmail.com',
        		'username' => 'alamin',
        		'phone' => '01876619765',
        		'address' => 'Mirpur-14',
        		'image' => Null,
        		'email_verified_at' => Carbon::now()->toDateTimeString(),
        		'password' => Hash::make('12345678'),
        	]
        ]);
    }
}
