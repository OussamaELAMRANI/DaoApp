<?php

use Illuminate\Database\Seeder;

class ChildCreateTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Child::class, 20)->create();
    }
}
