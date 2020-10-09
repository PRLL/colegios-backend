<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contracts\UserRepository;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email:rfc', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'max:255'],
            'type'     => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'     => ['string', 'max:255'],
            'email'    => ['email:rfc', 'string', 'unique:users,email'],
            'email' => ['sometimes', 'email:rfc', 'string', 'max:255', Rule::unique('users')->ignoreModel($user)]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user->update($request->all());
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'ok'], 204);
    }

    public function getUserTypes()
    {
        $userTypes = [];
        foreach (UserType::getItems() as $key => $value) {
            array_push($userTypes, [
                'id'    => $key,
                'value' => $value
            ]);
        }
        return $userTypes;
    }
}
