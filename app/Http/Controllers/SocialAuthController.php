<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(string $provider)
    {
        return match ($provider) {
            SocialAccount::SERVICE_GOOGLE => $this->redirectToGoogle(),
            SocialAccount::SERVICE_GITHUB => $this->redirectToGitHub(),
            default => abort(404),
        };
    }

    private function redirectToGoogle()
    {
        // Redirect the user to the Google authentication page
        return Socialite::driver(SocialAccount::SERVICE_GOOGLE)
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    private function redirectToGitHub()
    {
        // Redirect the user to the GitHub authentication page
        return Socialite::driver(SocialAccount::SERVICE_GITHUB)
            ->redirect();
    }

    public function callback(string $provider)
    {
        try {
            // Get the social user from the provider after they have been redirected
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('auth.login')->withErrors([
                'message' => 'Unable to authenticate with ' . $provider . '. Please try again.',
            ]);
        }

        $account = $this->findOrCreateUser($socialUser, $provider);

        Auth::login($account, true);

        return redirect()->route('home');
    }

    private function findOrCreateUser($socialUser, $provider)
    {
        $account = SocialAccount::where([
            'provider' => SocialAccount::SERVICE_GOOGLE,
            'provider_user_id' => $socialUser->id,
        ])->first();

        if ($account) {
            return $account->user;
        }

        $user = User::where('email', $socialUser->email)->first();

        if (is_null($user)) {
            $user = User::create([
                'username' => Str::snake($socialUser->name),
                'name' => $socialUser->name,
                'email' => $socialUser->email,
            ]);
        }

        $user->socialAccounts()->create([
            'provider' => $provider,
            'provider_user_id' => $socialUser->id,
        ]);

        return $user;
    }
}
