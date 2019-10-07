<?php

use App\TAD;
use Illuminate\Database\Seeder;

class TADsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TAD::class, 5)->create();
    }
}
