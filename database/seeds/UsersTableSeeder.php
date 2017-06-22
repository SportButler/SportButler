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
     DB::table('users')->truncate();


       $users = [
         [
           'email' =>'a.thomsen@mbd-team.de',
           'password' =>'teamupp',
         ],
         [
           'email' =>'m.moehle@mbd-team.de',
           'password' =>'teamupp'
         ],
         [
           'email' =>'r.braker@mbd-team.de',
           'password' =>'teamupp'
         ],
         [
           'email' =>'r.walder@mbd-team.de',
           'password' =>'teamupp'
         ],
         [
           'email' =>'fabianjace93@gmail.com',
           'password' =>'teamupp'
         ],
       ];

       		foreach ($users as $user)
       		{
       			Sentinel::registerAndActivate($user);
       		}

   }
}
