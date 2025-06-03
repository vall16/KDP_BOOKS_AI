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

            if (!$bookData) {
                return redirect()->route('book.create')->withErrors('Sessione scaduta.');
            }
            //chiave segreta ...
            Stripe::setApiKey(config('services.stripe.secret'));

            $checkout = StripeSession::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Creazione Libro - Pacchetto ' . ucfirst($bookData['pack']),
                        ],
                        'unit_amount' => 1999, // prezzo in centesimi (€19,99)
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('book.complete'),
                'cancel_url' => route('book.cancel'), // Deve essere una semplice URL
            ]);

            return redirect($checkout->url);
        } catch (\Exception $e) {
            Log::error('Errore Stripe: ' . $e->getMessage());
            return redirect()->route('book.create')->withErrors('Errore durante il checkout: ' . $e->getMessage());
        }
    }
}
