<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    //originale
    // public function redirect(Request $request)
    // {
    //     \Log::info('✳️ Entrato in GoogleController@redirect');

    //     $token = $request->query('token');

    //     if ($token) {
    //         session(['google_login_token' => $token]);
    //     }

    //     return Socialite::driver('google')->redirect();
    // }

    public function redirect2(Request $request)
    {
        \Log::info('✳️ Entrato in GoogleController@redirect');

        $token = $request->query('token');
        $nextAction = $request->query('next_action', 'default'); // fallback: 'default'

        if ($token) {
            session(['google_login_token' => $token]);
        }

        session(['google_next_action' => $nextAction]);

        return Socialite::driver('google')->redirect();
    }


    //originale
    // public function handleGoogleCallback()
    // {
    //     $googleUser = Socialite::driver('google')->stateless()->user();

    //     $user = User::firstOrCreate(
    //         ['email' => $googleUser->getEmail()],
    //         ['name' => $googleUser->getName()]
    //     );

    //     Auth::login($user);

    //     // Recupera il token salvato prima del login
    //     $token = session('google_login_token');

    //     if ($token) {
    //         //passo il token a STRIPE
    //         return redirect()->route('stripe.checkout', ['token' => $token]);
    //     }

    //     return redirect('/'); // fallback generico
    // }

    //callback paramterizzato...
    public function handleGoogleCallback2()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            ['name' => $googleUser->getName()]
        );

        Auth::login($user);

        $token = session('google_login_token');
        $nextAction = session('google_next_action', 'default');

        // 🔁 Switch su cosa fare dopo
        switch ($nextAction) {
            case 'stripe':
                // return redirect()->route('stripe.checkout', ['token' => $token]);
                if ($token) {
                    //passo il token a STRIPE
                    return redirect()->route('stripe.checkout', ['token' => $token]);
                }
            case 'dashboard':
                return redirect()->route('dashboard');
            case 'login-only':
                return redirect('/sell')->with('success', 'Login effettuato!');
            default:
                return redirect('/');
        }
    }

}
