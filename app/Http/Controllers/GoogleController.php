<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect(Request $request)
    {
        \Log::info('✳️ Entrato in GoogleController@redirect');

        $token = $request->query('token');

        if ($token) {
            session(['google_login_token' => $token]);
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            ['name' => $googleUser->getName()]
        );

        Auth::login($user);

        // Recupera il token salvato prima del login
        $token = session('google_login_token');

        if ($token) {
            //passo il token a STRIPE
            return redirect()->route('stripe.checkout', ['token' => $token]);
        }

        return redirect('/'); // fallback generico
    }
}
