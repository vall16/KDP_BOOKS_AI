
<x-app-layout>
    <div class="container text-center mt-5">
        <h1 class="text-success">✅ Pagamento completato con successo!</h1>
        <p class="lead mt-4">
            Grazie per il tuo acquisto! Il tuo libro è in fase di generazione.
        </p>

        <p class="mt-3">
            Riceverai una notifica via email (<strong>{{ auth()->user()->email }}</strong>) non appena sarà pronto.
        </p>

        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">
            Vai ai tuoi libri
        </a>
    </div>
</x-app-layout>

