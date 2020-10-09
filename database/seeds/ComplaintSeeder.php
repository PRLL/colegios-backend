<?php

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $submitUser)
        {
            if($submitUser->type == UserType::STUDENT)
            {
                foreach ($users as $complainUser)
                {
                    if($submitUser->id != $complainUser->id)
                    {
                        factory('App\Models\Complaint')->create([
                            'submitted_by' => $submitUser->id,
                            'complained_of' => $complainUser->id
                        ]);
                    }
                }
            }
        }
    }
}
