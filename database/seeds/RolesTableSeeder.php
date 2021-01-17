<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'user']);
    }
}
