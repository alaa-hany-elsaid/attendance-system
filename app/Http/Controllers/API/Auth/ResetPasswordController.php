<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendCodeRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{

    use  Response;

    public function sendCode(SendCodeRequest $request)
    {

        $user = User::where('email', $request->get('email'))->first();
        DB::table('password_reset_tokens')->updateOrInsert([
            'email' => $user->email,
            'token' => Str::reverse(trim(Str::substr(Str::reverse($user->phone), 0 , 5))),
        ], [
            'created_at' => Carbon::now(),
        ]);
        return $this->responseWithActionDoneSuccessfully('code sent successfully');

    }


    public function reset(ResetPasswordRequest $request)
    {
        if (DB::table('password_reset_tokens')
                ->where('token', $request->get('code'))
                ->where('email', $request->get('email'))
                ->first() && ($user = User::where('email', $request->get('email'))->first())) {
            $user->update([
                'password' => \Hash::make($request->get('password')),
            ]);
            return $this->responseWithActionDoneSuccessfully('Your password has been reset!');
        }

        return $this->responseWithModelNotFound("code ");
    }
}