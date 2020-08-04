<?php

use Illuminate\Database\Seeder;
use APP\Model\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,3)->create();
    }
}
