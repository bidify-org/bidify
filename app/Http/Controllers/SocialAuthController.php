<?php

namespace App\Http\Controllers;

use App\Exceptions\UserAlreadyRegistered;
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

            $account = $this->findOrCreateUser($socialUser, $provider);
        } catch (UserAlreadyRegistered $e) {
            return redirect()->route('auth.login')->withErrors([
                'message' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('auth.login')->withErrors([
                'message' => 'Unable to authenticate with ' . $provider . '. Please try again.',
            ]);
        }

        Auth::login($account, true);

        return redirect()->route('home');
    }

    private function findOrCreateUser($socialUser, $provider)
    {
        // Check if social account is already registered
        $account = SocialAccount::where([
            'provider' => $provider,
            'provider_user_id' => $socialUser->id,
        ])->first();

        if ($account) {
            return $account->user;
        }

        $existingUser = User::where('email', $socialUser->email)->first();

        // We need to check if a user with the same email address already exists
        // If so, we need to cancel the login process since it could be a hijack attempt
        if ($existingUser) {
            throw new UserAlreadyRegistered('There is already a user registered with the email address');
        }

        $newUser = User::create([
            'username' => Str::snake($socialUser->name),
            'name' => $socialUser->name,
            'email' => $socialUser->email,
        ]);

        $newUser->socialAccounts()->create([
            'provider' => $provider,
            'provider_user_id' => $socialUser->id,
        ]);

        return $newUser;
    }
}
