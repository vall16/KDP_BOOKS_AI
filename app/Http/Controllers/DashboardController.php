<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $email = $user->email;
        $encodedEmail = urlencode($email);

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.vibes_api.token'),
        ])->get("https://api.vibesrl.com/user_books?user_id={$encodedEmail}");

        $books = $response->successful() ? $response->json() : [];

        return view('dashboard', compact('user', 'books'));
    }

    public function downloadBook($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.vibes_api.token'),
            'accept' => 'application/pdf',
        ])->get("https://api.vibesrl.com/download/{$id}");

        if ($response->successful()) {
            return response($response->body(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="libro_{$id}.pdf"');
        } else {
            return back()->withErrors(['download_error' => 'Errore durante il download del file']);
        }
    }

    public function getBookDetails($id)
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.vibes_api.token'),
        ])->get("https://api.vibesrl.com/book/{$id}");

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Libro non trovato'], 404);
        }
    }


}
