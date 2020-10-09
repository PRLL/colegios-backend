<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Complaint;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => 'password',
        'remember_token'    => Str::random(10),
    ];
});

$factory->define(Teacher::class, function (Faker $faker) {
    return [
        'first_name'    => $faker->firstName,
        'last_name'     => $faker->lastName
    ];
});

$factory->define(Student::class, function (Faker $faker) {
    return [
        'first_name'    => $faker->firstName,
        'last_name'     => $faker->lastName
    ];
});

$factory->define(Complaint::class, function (Faker $faker) {
    return [
        'description'    => $faker->text,
    ];
});