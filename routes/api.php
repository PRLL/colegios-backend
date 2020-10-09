<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Login Routes
Route::group(['prefix' => 'auth'], function(){
    //Check user info based on token sent
    Route::get('checkUser', 'AuthController@checkUser')->middleware('auth:api');
    //Login
    Route::post('login', 'AuthController@login');
    //Logout
    Route::post('logout', 'AuthController@logout')->middleware('auth:api'); //
});

//User Routes
Route::group(['prefix' => 'user'], function () {
    //Get all users
    Route::get('/', 'UserController@index')->middleware('auth:api');
    //Get the user types
    Route::get('/getUserTypes', "UserController@getUserTypes")->middleware('auth:api');
    //Get User Info
    Route::get('/{user}', 'UserController@show')->middleware('auth:api');
    //Creates an user
    Route::post('/', 'UserController@store')->middleware('auth:api');
    //Updates an User
    Route::patch('/{user}', 'UserController@update')->middleware('auth:api');
    //Delete an User
    Route::delete('/{user}', 'UserController@destroy')->middleware('auth:api');
});

//Teacher Routes
Route::group(['prefix' => 'teacher'], function () {
    //Get all teachers
    Route::get('/', 'TeacherController@index')->middleware('auth:api');
    //Get Teacher Info
    Route::get('/{teacher}', 'TeacherController@show')->middleware('auth:api');
    //Creates a teacher
    Route::post('/', 'TeacherController@store')->middleware('auth:api');
    //Updates a teacher
    Route::patch('/{teacher}', 'TeacherController@update')->middleware('auth:api');
    //Delete a Teacher
    Route::delete('/{teacher}', 'TeacherController@destroy')->middleware('auth:api');
});

//Student Routes
Route::group(['prefix' => 'student'], function () {
    //Get all students
    Route::get('/', 'StudentController@index')->middleware('auth:api');
    //Get Student Info
    Route::get('/{student}', 'StudentController@show')->middleware('auth:api');
    //Creates a student
    Route::post('/', 'StudentController@store')->middleware('auth:api');
    //Updates a student
    Route::patch('/{student}', 'StudentController@update')->middleware('auth:api');
    //Delete a Student
    Route::delete('/{student}', 'StudentController@destroy')->middleware('auth:api');
});

//User Routes
Route::group(['prefix' => 'complaint'], function () {
    //Get all complaints
    Route::get('/', 'ComplaintController@index')->middleware('auth:api');
    //Get Complaint Info
    Route::get('/{complaint}', 'ComplaintController@show')->middleware('auth:api');
    //Creates a complaint
    Route::post('/', 'ComplaintController@store')->middleware('auth:api');
    //Updates a complaint
    Route::patch('/{complaint}', 'ComplaintController@update')->middleware('auth:api');
    //Delete a Complaint
    Route::delete('/{complaint}', 'ComplaintController@destroy')->middleware('auth:api');
});
