<x-app-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center max-w-xl">
            <h1 class="text-2xl font-bold text-red-600 mb-4">❌ Si è verificato un errore</h1>
            <p class="text-gray-700 mb-6">
                <!-- {{ $message ?? 'Errore sconosciuto.' }} -->
                {{ session('message') ?? 'Errore sconosciuto.' }}
            </p>
            <a href="{{ route('sell') }}" class="btn btn-primary">
                Torna alla creazione del libro
            </a>
        </div>
    </div>
</x-app-layout>
