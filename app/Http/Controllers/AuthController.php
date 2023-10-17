<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validation->errors(),
            ], 422);
        }

        $user = User::create($validation->validated());
        $userToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Successfully registered',
            'user' => $user,
            'token' => $userToken,
        ], 201);
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validation->errors(),
            ], 422);
        }

        $data = $validation->validated();

        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = User::where('email', $data['email'])->first();
        $userToken = $user->createToken('access_token')->plainTextToken;

        return response()->json([
            'message' => 'Successfully logged in',
            'user' => $user,
            'token' => $userToken,
        ], 200);
    }
}
