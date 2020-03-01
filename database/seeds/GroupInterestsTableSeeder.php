<?php

use Illuminate\Database\Seeder;

class GroupInterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GroupInterest::class, 300)->create();
    }
}
