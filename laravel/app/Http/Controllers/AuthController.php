<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        // Retrive user
        $user = User::where('name', $request->name)->first();

        // Check user
        if ($user === null) {
            return api_response(failure('User not exists'));
        }

        // Check password
        if (!Hash::check($request->password, $user->password)) {
            return api_response(failure('Password mismatch'));
        }

        // Create token
        $token = $user->createToken('default')->plainTextToken;
        // $token = $user->createToken('default', [''])->plainTextToken;

        return api_response(success([
            'token' => $token,
            'user'  => $user->only('id', 'name'),
        ]));
    }

    /**
     * Logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        return api_response(
            $request->user()->currentAccessToken()->delete()
                ? success()
                : failure()
        );
    }
}
