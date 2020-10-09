<?php

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user)
        {
            if($user->type == UserType::TEACHER)
            {
                factory('App\Models\Teacher')->create([
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
