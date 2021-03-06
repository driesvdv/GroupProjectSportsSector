<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required',
            'password' => 'required|min:5'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:5'
        ]);

        if (!Auth::attempt($loginData))
        {
            return response(['message' => 'Invalid Credentials'], 403);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response()->json(['user' => Auth::user(), 'access_token' => $accessToken]);

    }
}
