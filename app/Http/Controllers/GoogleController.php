<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(uniqid()) // solo se necessario
            ]
        );

        Auth::login($user);

        // originale
        // return redirect('/dashboard'); // o dove vuoi

        //  Dopo login, reindirizza al pagamento: PAGAMENTO !!
        return redirect()->route('stripe.checkout');
    }
}

