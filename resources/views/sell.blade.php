<x-app-layout>
  <main class="max-w-5xl mx-auto py-16 px-4 bg-gray-50 min-h-screen"
        x-data="{ selected: null }">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Choose Your Package</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach(config('pacchetti') as $codice => $pacchetto)
      <div @click="selected = '{{ $codice }}'"
          :class="selected === '{{ $codice }}' ? 'border-blue-600 ring ring-blue-300' : 'border-transparent'"
          class="package bg-white shadow-md rounded-lg p-6 text-center cursor-pointer transition border-2">
        <h3 class="text-xl font-semibold mb-4">Package {{ $pacchetto['name'] }}</h3>
        <p class="text-gray-600 mb-4">{{ $pacchetto['description'] }}</p>
        <p class="text-2xl font-bold mb-4">€{{ number_format($pacchetto['price'], 2, ',', '.') }}</p>
        <button
          class="create-btn inline-block px-6 py-2 bg-blue-600 text-white rounded"
          :class="selected === '{{ $codice }}' ? '' : 'opacity-50 cursor-not-allowed'"
          :disabled="selected !== '{{ $codice }}'"
          @click.stop="window.location.href = '/crea-libro?pack={{ $codice }}'">
          Crea
        </button>
      </div>
      @endforeach

    </div>
  </main>
</x-app-layout>
