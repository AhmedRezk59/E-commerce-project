<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CheckUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(CheckUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The Credentials aren\'t correct'
            ]);
        }
        $token = $user->createToken('Access-Token')->plainTextToken;
        $user = [
            'token' => $token,
            'data' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ];
        return $user;
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response('You logged out successfully', 201);
    }
}
