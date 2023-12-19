<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(AuthLoginRequest $request)
    {
        $validated = $request->validated();
        if (!Auth::attempt($validated)) {
            return redirect()->route('auth.login')->withErrors([
                'message' => 'Invalid credentials',
            ]);
        }

        return redirect()->route('home');
    }


    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(AuthRegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('auth.login');
    }
}
