<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Role_UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('role_users')->insert([
        'user_id' => '1',
        'role_id' => '1',
      ]);

      DB::table('role_users')->insert([
        'user_id' => '2',
        'role_id' => '1',
      ]);

      DB::table('role_users')->insert([
        'user_id' => '3',
        'role_id' => '1',
      ]);

      DB::table('role_users')->insert([
        'user_id' => '4',
        'role_id' => '2',
      ]);

      DB::table('role_users')->insert([
        'user_id' => '5',
        'role_id' => '1',
      ]);

    }
}
