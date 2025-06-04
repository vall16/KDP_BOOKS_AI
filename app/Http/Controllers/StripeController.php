<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    
    public function checkout()
    {
        try {
            $bookData = session('book_data');

            Log::info('PACCHETTO STRIPE', ['pack' => session('book_data.pack')]);

            if (!$bookData) {
                return redirect()->route('book.create')->withErrors('Sessione scaduta.');
            }

            // Prendi il pacchetto scelto
            $packCode = $bookData['pack'];

            // Recupera i dati del pacchetto dalla config
            $pacchetti = config('pacchetti');

            if (!isset($pacchetti[$packCode])) {
                return redirect()->route('book.create')->withErrors('Pacchetto non valido.');
            }

            $pacchetto = $pacchetti[$packCode];

            Stripe::setApiKey(config('services.stripe.secret'));

            $checkout = StripeSession::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Creazione Libro - Pacchetto ' . $pacchetto['nome'],
                        ],
                        'unit_amount' => 1200
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('book.complete'),
                'cancel_url' => route('book.cancel'),
            ]);

            return redirect($checkout->url);
        } catch (\Exception $e) {
            Log::error('Errore Stripe: ' . $e->getMessage());
            return redirect()->route('book.create')->withErrors('Errore durante il checkout: ' . $e->getMessage());
        }
    }
}


