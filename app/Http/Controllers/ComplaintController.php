<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Complaint::all()->load('submittedBy', 'complainedOf');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description'   => ['required', 'string', 'max:255'],
            'complained_of' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if (Auth::user()->type != UserType::STUDENT) {
            $validator->errors()->add('submitted_by', 'Only users of  type STUDENT can submit complaints');
            return response()->json(['errors' => $validator->errors()]);
        }

        $request->submitted_by = Auth::user()->type;

        $complaint = Complaint::create($request->all());
        return response()->json($complaint, 201);
    }

    public function show(Complaint $complaint)
    {
        return $complaint;
    }

    public function update(Request $request, Complaint $complaint)
    {
        $validator = Validator::make($request->all(), [
            'description'   => ['string', 'max:255'],
            'complained_of' => ['numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if (Auth::user()->type != UserType::STUDENT) {
            $validator->errors()->add('submitted_by', 'The submitted_by user must be of type STUDENT');
            return response()->json(['errors' => $validator->errors()]);
        }

        $request->submitted_by = Auth::user()->type;

        $complaint->update($request->all());
        return $complaint;
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return response()->json(['message' => 'ok'], 204);
    }
}
