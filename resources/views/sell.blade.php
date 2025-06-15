<x-app-layout>
<div class="bg-black min-h-screen text-white px-[100px]">

  
    <main class="py-16 px-4 bg-black text-white min-h-screen"
            x-data="{ selected: null }">
        <h2 class="text-3xl font-bold text-center mb-12 text-white">Choose Your Package</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          @foreach(config('pacchetti') as $codice => $pacchetto)
          <div @click="selected = '{{ $codice }}'"
              :class="selected === '{{ $codice }}' ? 'ring ring-orange-300' : ''"
              class="package bg-black text-white border-2 border-orange-500 shadow-md rounded-lg p-6 text-center cursor-pointer transition">
            <h3 class="text-xl font-semibold mb-4 border-b border-orange-500 pb-2">Package {{ $pacchetto['name'] }}</h3>
            <ul class="mb-4 space-y-1 text-gray-300">
              @foreach ($pacchetto['description_lines'] as $line)
                <li class="border-b border-orange-500 pb-1">{{ $line }}</li>
              @endforeach
            </ul>
            <p class="text-2xl font-bold mb-4 border-b border-orange-500 pb-2">€{{ number_format($pacchetto['price'], 2, ',', '.') }}</p>
            <button
              class="create-btn inline-block px-8 py-3 bg-black text-white font-bold text-lg border-4 border-orange-500 rounded-full hover:bg-gray-200 transition"
              :class="selected === '{{ $codice }}' ? '' : 'opacity-50 cursor-not-allowed'"
              :disabled="selected !== '{{ $codice }}'"
              @click.stop="window.location.href = '/crea-libro?pack={{ $codice }}'">
              Create
            </button>

          </div>
          @endforeach
        </div>
      </main>
  </div>
</x-app-layout>
