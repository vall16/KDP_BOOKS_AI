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

        // Prepara i dati
        $payload = [
            'lang_code' => $request->book_language,
            'language' => $request->book_language,
            'titolo_libro' => $request->book_title,
            'descrizione_libro' => $request->book_description,
            'num_capitoli' => (string) $request->min_chapters,
            'nome_file' => Str::slug($request->book_title, '_'),
            'email' => $request->user_email,
            'nome_utente' => $request->author_name,
        ];

        // Effettua la chiamata all'API
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.vibes_api.token'),
            'Content-Type' => 'application/json',
        ])->post('https://api.vibesrl.com/writebook', $payload);

        // Controlla la risposta
        if ($response->successful()) {
            $data = $response->json();
            return redirect()->back()->with('success', 'Libro generato con successo!');
        } else {
            return redirect()->back()->withErrors(['api_error' => 'Errore generazione libro: ' . $response->body()]);
        }
    }
}
