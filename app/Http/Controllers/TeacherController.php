<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Teacher::all()->load('user', 'students');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'user_id'       => ['required', 'numeric', 'unique:teachers,user_id']
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if (User::where('id', $request->user_id)->value('type') != UserType::TEACHER) {
            $validator->errors()->add('user_id', 'The user must be of type TEACHER');
            return response()->json(['errors' => $validator->errors()]);
        }
        
        $teacher = Teacher::create($request->all());
        return response()->json($teacher, 201);
    }

    public function show(Teacher $teacher)
    {
        return $teacher;
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => ['string', 'max:255'],
            'last_name'     => ['string', 'max:255'],
            'user_id'       => ['sometimes', 'numeric', Rule::unique('teachers')->ignoreModel($teacher)]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user_id = $request->user_id == null ? $teacher->user_id : $request->user_id;

        if (User::where('id', $user_id)->value('type') != UserType::TEACHER) {
            $validator->errors()->add('user_id', 'The user must be of type TEACHER');
            return response()->json(['errors' => $validator->errors()]);
        }

        $teacher->update($request->all());
        return $teacher;
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(['message' => 'ok'], 204);
    }
}
