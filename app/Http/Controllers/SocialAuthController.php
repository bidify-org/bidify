<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        // Redirect the user to the Google authentication page
        return Socialite::driver(SocialAccount::SERVICE_GOOGLE)
            ->stateless()
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function callback()
    {
        // Get the social user from the provider after they have been redirected
        $socialUser = Socialite::driver(SocialAccount::SERVICE_GOOGLE)
            ->stateless()
            ->user();

        abort_if(!$socialUser, 401, 'Unable to authenticate with Google.');

        $account = SocialAccount::where([
            'provider' => SocialAccount::SERVICE_GOOGLE,
            'provider_user_id' => $socialUser->id,
        ])->first();

        // If the user has already signed up with this social account before
        // we can just log them in.
        if ($account) {
            return $this->createToken($account->user);
        }

        // Otherwise, if no user has signed up with this social account before
        // we need to find a user with the same email address as the social user.
        $user = User::where('email', $socialUser->email)->first();

        // If no user exists with the same email address as the social user
        // we need to register the new user. Otherwise, we can just log them in
        // and create a new social account record for them.
        if (!$user) {
            $user = User::create([
                // Convert name to username (e.g. John Doe => john_doe)
                'username' => Str::snake($socialUser->name),
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => bcrypt(Str::random(32)), // Random password
            ]);
        }

        // Create a new social account record for the user.
        $user->socialAccounts()->create([
            'provider' => SocialAccount::SERVICE_GOOGLE,
            'provider_user_id' => $socialUser->id,
        ]);

        return $this->createToken($user);
    }

    private function createToken(User $user)
    {
        $userToken = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $userToken,
        ]);
    }
}
