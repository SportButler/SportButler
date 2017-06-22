<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('fields')->insert([
        'club_id' => '1',
        'name' => 'Feld 1',
        'description' => 'Der erste unserer Tennisplätze',
        'maxplayers' => '4',
        'priceperhour' => '0',
      ]);

      DB::table('fields')->insert([
        'club_id' => '1',
        'name' => 'Feld 2',
        'description' => 'Der zweite unserer Tennisplätze',
        'maxplayers' => '4',
        'priceperhour' => '0',
      ]);

      DB::table('fields')->insert([
        'club_id' => '1',
        'name' => 'Feld 3',
        'description' => 'Der dritte unserer Tennisplätze',
        'maxplayers' => '4',
        'priceperhour' => '0',
      ]);

      DB::table('fields')->insert([
        'club_id' => '1',
        'name' => 'Feld 4',
        'description' => 'Der vierte unserer Tennisplätze',
        'maxplayers' => '4',
        'priceperhour' => '0',
      ]);
    }
}
