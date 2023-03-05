<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    public function signIn(SignInRequest $request)
    {

        if (! Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'message' => 'User Logged In Successfully',
            'token'   => $user->createToken("token")->plainTextToken,
            'role'    => $user->role,
        ]);

    }

    public function getRole(Request $request)
    {
        return response()->json([
            'role' => auth()->user()->role,
        ]);

    }

}
