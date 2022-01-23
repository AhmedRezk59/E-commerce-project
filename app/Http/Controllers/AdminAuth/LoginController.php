<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CheckAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(CheckAdminRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => 'The Credentials aren\'t correct'
            ]);
        }
        $token = $admin->createToken('Access-Token')->plainTextToken;
        $admin = [
            'name' => $admin->name,
            'is_super' => $admin->is_super,
        ];
        return response(['token' => $token, 'admin' => $admin], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response('You logged out successfully', 201);
    }
}
