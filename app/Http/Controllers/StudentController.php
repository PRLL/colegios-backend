<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Student::all()->load('user', 'teacher');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'teacher_id'    => ['required', 'numeric'],
            'user_id'       => ['required', 'numeric', 'unique:students,user_id']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if (User::where('id', $request->user_id)->value('type') != UserType::STUDENT) {
            $validator->errors()->add('user_id', 'The user must be of type STUDENT');
            return response()->json(['errors' => $validator->errors()]);
        }

        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function show(Student $student)
    {
        return $student;
    }

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => ['string', 'max:255'],
            'last_name'     => ['string', 'max:255'],
            'teacher_id'    => ['numeric'],
            'user_id'       => ['sometimes', 'numeric', Rule::unique('students')->ignoreModel($student)]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user_id = $request->user_id == null ? $student->user_id : $request->user_id;

        if (User::where('id', $user_id)->value('type') != UserType::STUDENT) {
            $validator->errors()->add('user_id', 'The user must be of type STUDENT');
            return response()->json(['errors' => $validator->errors()]);
        }

        $student->update($request->all());
        return $student;
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'ok'], 204);
    }
}
