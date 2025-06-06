<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    
    public function create(Request $request)
    {
        $packCode = $request->query('pack'); // esempio: "base"

        $pacchetti = config('pacchetti');

        if (!array_key_exists($packCode, $pacchetti)) {
            abort(404, 'Pacchetto non valido');
        }

        $pacchetto = $pacchetti[$packCode];

        // Salva il pacchetto nella sessione attiva
        session()->put('book_data.pack', $packCode);

        // return view('crea-libro', compact('pacchetto'));
        return view('crea-libro', compact('pacchetto', 'packCode'));

    }


    private function generateBook(array $data)
    {
        $payload = [
            'user_email' => $data['user_email'],
            'author_name' => $data['author_name'],
            'book_title' => $data['book_title'],
            'book_description' => $data['book_description'],
            'book_language' => $data['book_language'],
            'min_chapters' => (string) $data['min_chapters'],
            'min_words_per_chapter' => (string) $data['min_words_per_chapter'],
        ];

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.vibes_api.token'),
            'Content-Type' => 'application/json',
        ])->post('https://api.vibesrl.com/schedule_book', $payload);

        return $response;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'author_name' => 'required|string|max:255',
            'book_title' => 'required|string|max:255',
            'book_description' => 'required|string',
            'book_language' => 'required|string',
            'min_chapters' => 'required|integer|min:1',
            'min_words_per_chapter' => 'required|integer|min:1',
        ]);

        $response = $this->generateBook($request->all());

        if ($response->successful()) {
            return redirect()->back()->with('success', '✅ Libro generato con successo!');
        } else {
            return redirect()->back()->withErrors([
                'api_error' => '❌ Errore nella generazione del libro: ' . $response->body()
            ])->withInput();
        }
    }


    public function userBooks(string $email)
    {
        // Codifica dell'email per l'URL
        $encodedEmail = urlencode($email);

        // Chiamata all'API
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.vibes_api.token'),
        ])->get("https://api.vibesrl.com/user_books?user_id={$encodedEmail}");

        // Controlla la risposta
        if ($response->successful()) {
            $books = $response->json();
            return view('libri-utente', compact('books', 'email'));
        } else {
            return back()->withErrors(['api_error' => 'Errore recupero libri: ' . $response->body()]);
        }
    }


    public function startCheckout(Request $request)
    {
        $validated = $request->validate([
            'user_email' => 'required|email',
            'author_name' => 'required|string',
            'book_title' => 'required|string',
            'book_description' => 'required|string',
            'book_language' => 'required|string',
            'min_chapters' => 'required|integer|min:1',
            'min_words_per_chapter' => 'required|integer|min:1',
            'pack' => 'required|string|in:base,plus,premium',
        ]);

        // Recupera i dati completi del pacchetto scelto
        // Log::info('PACCHETTO STRIPE', ['pack' => $bookData['pack']]);
        $packCode = $validated['pack'];
        $pacchetti = config('pacchetti');

        if (!array_key_exists($packCode, $pacchetti)) {
            return redirect()->back()->withErrors(['pack' => 'Pacchetto non valido']);
        }

        $packData = $pacchetti[$packCode];

        //DATI SALVATI TEMPORANEAMENTE IN CACHE CON UN TOKEN
        $token = Str::uuid()->toString();


        cache()->put("book_data_$token", array_merge($validated, [
            'prezzo' => $packData['prezzo'],
            'nome_pacchetto' => $packData['nome'],
            'descrizione_pacchetto' => $packData['descrizione'],
        ]), now()->addMinutes(15));

        session(['temp_token' => $token]);

        // /auth/google?token=abc123&next_action=stripe

        //originale
        // if (!auth()->check()) {
        //     //autenticazione google con token per dati di sessione
        //     return redirect()->route('auth.google', ['token' => $token]);
        // }
        if (!auth()->check()) {
            //autenticazione google con token per dati di sessione
            return redirect()->route('auth.google', ['token' => $token,'next_action' => 'stripe']);
        }

        // indirizzamento a stripe con dati di sessione
        return redirect()->route('stripe.checkout', ['token' => $token]);

    }


    public function complete(Request $request)
    {
        $token = $request->query('token');

        Log::info("COMPLETE.Token ricevuto: $token");
        Log::info("COMPLETE.Esiste in cache: ", ['exists' => cache()->has("book_data_$token")]);

        if (!$token) {
            Log::warning('Token mancante nella richiesta di completamento Stripe');
            return redirect()->route('error')->with('message', '⚠️ Token mancante');
            
        }

        $bookData = cache("book_data_$token");

        if (!$bookData) {
            Log::warning("Dati libro non trovati o cache scaduta per token: $token");
            return redirect()->route('error')->with('message', '⚠️ Sessione scaduta o dati non trovati.');
            
        }

        Log::info('Token ricevuto da Stripe:', ['token' => $token]);
        Log::debug('Dati recuperati dalla cache per generazione libro:', $bookData);

        // Simuliamo una richiesta HTTP con i dati dalla cache
        $generateRequest = new Request($bookData);

        try {
            Log::info('Inizio chiamata al metodo generate()');
            
            
            app()->call([app(BookController::class), 'generate'], ['request' => $generateRequest]);


            // Rimuovi i dati dalla cache!!
            cache()->forget("book_data_$token");
            Log::info('Cache rimossa per token: ' . $token);

            return view('bookscomplete')->with('success', '✅ Libro generato con successo!');
        } catch (\Exception $e) {
            Log::error('Errore durante la generazione del libro: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'token' => $token
            ]);

             return redirect()->route('error')->with('message', '❌ Errore nella generazione del libro' . $e->getMessage());
        }
    }


}
