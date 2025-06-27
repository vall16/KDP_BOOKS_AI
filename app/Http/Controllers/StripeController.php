<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    

    public function checkout(Request $request)
{
    try {

        $bookData = session('book_data');
        Log::info('PACCHETTO STRIPE', ['pack' => $bookData['pack'] ?? 'nessun pack trovato']);

        $bookData = session('book_data');

        if (!$bookData) {
            $token = $request->query('token');

            if (!$token) {
                return redirect()->route('book.create')->withErrors('Sessione scaduta o token mancante.');
            }

            $bookData = cache("book_data_$token");

            if (!$bookData) {
                return redirect()->route('book.create')->withErrors('Token non valido o scaduto.');
            }

            session(['book_data' => $bookData]);

        
        }

        // Prendi il pacchetto scelto
        $packCode = $bookData['pack'];
        $pacchetti = config('pacchetti');

        if (!isset($pacchetti[$packCode])) {
            return redirect()->route('book.create')->withErrors('Pacchetto non valido.');
        }

        $pacchetto = $pacchetti[$packCode];

        Stripe::setApiKey(config('services.stripe.secret'));
        $prezzoCentesimi = (int) round($pacchetto['price'] * 100);

        $checkout = StripeSession::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Creazione Libro - Pacchetto ' . $pacchetto['name'],
                    ],
                    'unit_amount' => $prezzoCentesimi,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',

            //se ha successo passo il token
            // 'success_url' => route('book.complete', ['token' => $request->query('token')]),
            'success_url' => route('book.complete2', ['token' => $request->query('token')]),

             // se non ha successo, cambio rotta   
            'cancel_url' => route('book.cancel'),
        ]);

        return redirect($checkout->url);

    } catch (\Exception $e) {
        Log::error('Errore Stripe: ' . $e->getMessage());
        
        return redirect()->route('error')->with('message', $e->getMessage());

    }
}

}


