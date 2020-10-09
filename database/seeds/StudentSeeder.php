<?php

use App\Models\User;
use App\Models\Teacher;
use App\Enums\UserType;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $teachers = Teacher::all();

        $teacherIds = [];

        foreach($teachers as $teacher)
        {
            array_push($teacherIds, $teacher->id);
        }

        foreach ($users as $user)
        {
            if($user->type == UserType::STUDENT)
            {
                factory('App\Models\Student')->create([
                    'user_id' => $user->id,
                    'teacher_id' => $teacherIds[array_rand($teacherIds,1)],
                ]);
            }
        }
    }
}
