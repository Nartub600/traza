<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create(['name' => 'INTI', 'active' => true, 'fixed' => true ]);
        Group::create(['name' => 'IRAM', 'active' => true, 'fixed' => true ]);
    }
}
