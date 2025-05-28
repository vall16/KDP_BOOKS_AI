<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create(Request $request)
    {
        $pack = $request->query('pack'); // "base", "plus", "premium"
        return view('crea-libro', compact('pack'));
    }

    public function generate(Request $request)
    {
        $pack = $request->input('pack');
        $title = $request->input('title');
        $idea = $request->input('idea');

        // Simula generazione
        $content = "Titolo: $title\n\nContenuto generato per il pacchetto $pack sulla base dell'idea: $idea";

        // Puoi salvare, generare PDF o mostrare il contenuto
        return view('book-preview', compact('title', 'content'));
    }

}

