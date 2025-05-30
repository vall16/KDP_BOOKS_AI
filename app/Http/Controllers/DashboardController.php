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
}
