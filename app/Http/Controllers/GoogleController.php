<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt; 

class GoogleController extends Controller
{


    public function redirect(Request $request)
    {
        \Log::info('✳️ Entrato in GoogleController@redirect');

        $token = $request->query('token');
        $nextAction = $request->query('next_action', 'default'); // fallback: 'default'

        // Codifica sicura del "state"
        $state = encrypt(json_encode([
            'token' => $token,
            'next_action' => $nextAction,
        ]));

        return Socialite::driver('google')
            ->stateless()
            ->with(['state' => $state])
            ->redirect();
    }


    // public function redirect(Request $request)
    // {
    //     \Log::info('✳️ Entrato in GoogleController@redirect');

    //     $token = $request->query('token');
    //     $nextAction = $request->query('next_action', 'default'); // fallback: 'default'

    //     if ($token) {
    //         session(['google_login_token' => $token]);
    //     }

    //     session(['google_next_action' => $nextAction]);

    //     return Socialite::driver('google')->redirect();
    // }

    //callback paramterizzato...
    // public function handleGoogleCallback()
    // {
    //     $googleUser = Socialite::driver('google')->stateless()->user();

    //     $user = User::firstOrCreate(
    //         ['email' => $googleUser->getEmail()],
    //         ['name' => $googleUser->getName()]
    //     );

    //     Auth::login($user);

    //     $token = session('google_login_token');

    //     Log::debug('Token in sessione dopo login:', ['token' => session('google_login_token')]);

    //     $nextAction = session('google_next_action', 'default');

    //     // 🔁 Switch su cosa fare dopo
    //     switch ($nextAction) {
    //         case 'stripe':
    //             // return redirect()->route('stripe.checkout', ['token' => $token]);
    //             if ($token) {
    //                 //passo il token a STRIPE
    //                 return redirect()->route('stripe.checkout', ['token' => $token]);
    //             }
    //             break;
    //         case 'dashboard':
    //             return redirect()->route('dashboard');
    //         case 'login-only':
    //             return redirect('/sell')->with('success', 'Login effettuato!');
    //         default:
    //             return redirect('/sell');
    //     }
    // }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Decripta lo "state"
        try {
            $state = json_decode(decrypt(request('state')), true);
            $token = $state['token'] ?? null;
            $nextAction = $state['next_action'] ?? 'default';
        } catch (\Exception $e) {
            \Log::error('Errore decrypt state Google: ' . $e->getMessage());
            return redirect('/sell')->withErrors('Errore durante l\'autenticazione Google');
        }

        // Login o creazione utente
        $user = \App\Models\User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            ['name' => $googleUser->getName()]
        );

        Auth::login($user);

        \Log::debug('✅ Login Google OK - Redirect verso azione: ' . $nextAction);

        switch ($nextAction) {
            case 'stripe':
                if ($token) {
                    return redirect()->route('stripe.checkout', ['token' => $token]);
                }
                break;
            case 'dashboard':
                return redirect()->route('dashboard');
            case 'login-only':
                return redirect('/sell')->with('success', 'Login effettuato!');
            default:
                return redirect('/sell');
        }
    }


}
