<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // InterestsTableSeeder::class,
        $this->call([ //
            GroupsTableSeeder::class,
            UsersTableSeeder::class,
            GroupInterestsTableSeeder::class,
            SubscriptionsTableSeeder::class
        ]);
    }
}
