<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function create(Request $request)
    {
        $pack = $request->query('pack'); // "base", "plus", "premium"
        return view('crea-libro', compact('pack'));
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

        // Prepara il payload secondo le specifiche API
        $payload = [
            'user_email' => $request->user_email,
            'author_name' => $request->author_name,
            'book_title' => $request->book_title,
            'book_description' => $request->book_description,
            'book_language' => $request->book_language,
            'min_chapters' => (string) $request->min_chapters,
            'min_words_per_chapter' => (string) $request->min_words_per_chapter,
        ];

        // Chiamata API
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.vibes_api.token'),
            'Content-Type' => 'application/json',
        ])->post('https://api.vibesrl.com/schedule_book', $payload);

        // Gestione della risposta
        if ($response->successful()) {
            $data = $response->json();
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


}
