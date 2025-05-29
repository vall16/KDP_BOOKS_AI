<x-app-layout>
  <main class="max-w-5xl mx-auto py-16 px-4 bg-gray-50 min-h-screen"
        x-data="{ selected: null }">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Scegli il tuo pacchetto</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach([
        ['nome' => 'Base', 'descrizione' => '1 libro, copertina semplice', 'prezzo' => '€9,99'],
        ['nome' => 'Plus', 'descrizione' => '3 libri, copertine HD', 'prezzo' => '€24,99'],
        ['nome' => 'Premium', 'descrizione' => '10 libri, AI avanzata + copertine HD', 'prezzo' => '€59,99'],
      ] as $i => $pacchetto)
        <div @click="selected = {{ $i }}"
             :class="selected === {{ $i }} ? 'border-blue-600 ring ring-blue-300' : 'border-transparent'"
             class="package bg-white shadow-md rounded-lg p-6 text-center cursor-pointer transition border-2">
          <h3 class="text-xl font-semibold mb-4">Pacchetto {{ $pacchetto['nome'] }}</h3>
          <p class="text-gray-600 mb-4">{{ $pacchetto['descrizione'] }}</p>
          <p class="text-2xl font-bold mb-4">{{ $pacchetto['prezzo'] }}</p>
          <button
            class="create-btn inline-block px-6 py-2 bg-blue-600 text-white rounded"
            :class="selected === {{ $i }} ? '' : 'opacity-50 cursor-not-allowed'"
            :disabled="selected !== {{ $i }}"
            @click.stop="window.location.href = '/crea-libro?pack={{ strtolower($pacchetto['nome']) }}'">
            Crea
          </button>
        </div>
      @endforeach
    </div>
  </main>
</x-app-layout>
