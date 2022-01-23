<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ResetEmailRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Mail\User\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{

    public function send_reset_mail(ResetEmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            $token = app('auth.password.broker')->createToken($user);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($user->email)->send(new ResetPassword(['data' => $user, 'token' => $token]));
            
            return response('E-mail got sent to you mail , check your mail now' , 200);
        }
        return response('Credentials aren\'t valid' , 422);
    }

    public function check_token($token)
    {
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->subHours(2))
            ->settings(['timezone' => 'Africa/Cairo']);

        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', $datetime)->first();
        if (!empty($check_token)) {
            return response('token is valid' , 200);
        } else {
            return response('token is no longer valid' , 403);
        }
    }

    public function reset($token, ResetPasswordRequest $request)
    {
        $datetime = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->subHours(2))
            ->settings(['timezone' => 'Africa/Cairo']);

        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', $datetime)->first();
        if (!empty($check_token)) {

            User::where('email', $check_token->email)->update([
                'password' => Hash::make($request->password),
            ]);

            DB::table('password_resets')->where('email', $check_token->email)->delete();


            return response('Password Reseted successfully', 201);
        } else {
            return response('Check token isn\'t valid', 403);
        }
    }
}
