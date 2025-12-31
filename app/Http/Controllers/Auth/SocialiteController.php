<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialiteController extends Controller
{
    /**
     * Redirect to Google for authentication
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName() ?? $googleUser->getNickname(),
                    'provider' => 'google',
                    'id_provider' => $googleUser->getId(),
                    'profile_image' => $googleUser->getAvatar(),
                ]
            );

            Auth::login($user, true);
            return redirect()->intended('dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['google' => 'Gagal login dengan Google.']);
        }
    }
}
