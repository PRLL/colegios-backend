<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'string', 'email:rfc'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 200);
        }

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
            'status'   => true
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expire_at'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user'         => $user
        ]);
    }

    public function logout(Request $request)
    {
        $response = $request->user()->token()->revoke();
        return $response ? response()->json(['message' => 'Te has desconectado correctamente.']) : response()->json(['message' => 'Ha ocurrido un error.']);
    }

    public function checkUser(Request $request)
    {
        return $request->user();
    }
}
