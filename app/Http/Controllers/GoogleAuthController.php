<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),  // <-- Tambahkan ini
                'password' => bcrypt(Str::random(16)),
            ]
        );

        if (!$user->hasAnyRole(['user', 'admin', 'whatever'])) {
            $user->assignRole('user'); // role default
        }

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
