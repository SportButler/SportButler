<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(FieldsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(JokesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(Role_UsersTableSeeder::class);

        //Model::reguard();
    }
}
