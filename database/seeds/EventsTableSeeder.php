<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('events')->insert([
        'field_id' => '1',
        'start' => '2017-02-24,10:00:00',
        'end' => '2017-02-24,12:00:00',
        'description' => 'Saisonauftakt',
        'players' => '4',
        'currentplayers' => '2',
      ]);

      DB::table('events')->insert([
        'field_id' => '2',
        'start' => '2017-02-24,10:00:00',
        'end' => '2017-02-24,12:00:00',
        'description' => 'Saisonauftakt',
        'players' => '4',
        'currentplayers' => '2',
      ]);

      DB::table('events')->insert([
        'field_id' => '4',
        'start' => '2017-02-24,10:00:00',
        'end' => '2017-02-24,12:00:00',
        'description' => 'Saisonauftakt',
        'players' => '2',
        'currentplayers' => '2',
      ]);

      DB::table('events')->insert([
        'field_id' => '1',
        'start' => '2017-02-24,12:00:00',
        'end' => '2017-02-24,14:00:00',
        'description' => 'Saisonauftakt',
        'players' => '4',
        'currentplayers' => '2',
      ]);
    }
}
