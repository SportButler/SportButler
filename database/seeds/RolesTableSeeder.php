<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
        'id' => '1',
        'slug' => 'lieferant',
        'name' => 'Lieferant',
      ]);

      DB::table('roles')->insert([
        'id' => '2',
        'slug' => 'admin',
        'name' => 'Admin',
      ]);

      DB::table('roles')->insert([
        'id' => '3',
        'slug' => 'kunde',
        'name' => 'Kunde',
      ]);

    }
}
