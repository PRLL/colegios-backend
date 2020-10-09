<?php

use App\Enums\UserType;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin User
        factory('App\Models\User')->create([
            'type' => UserType::ADMIN
        ]);

        //Receptionist
        factory('App\Models\User', 2)->create([
            'type' => UserType::TEACHER
        ]);

        //Receptionist
        factory('App\Models\User', 4)->create([
            'type' => UserType::STUDENT
        ]);
    }
}
