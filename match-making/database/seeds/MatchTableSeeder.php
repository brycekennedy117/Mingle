<?php

use Illuminate\Database\Seeder;

class MatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->call([UserTableSeeder::class]);
        factory(App\MingleLibrary\Models\Match::class, 1000)->make();

    }
}
