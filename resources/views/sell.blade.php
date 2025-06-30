<x-app-layout>

 
<div class="min-h-screen text-white px-[100px] bg-contain bg-no-repeat bg-top"
     style="background-image: url('/images/sfondo.PNG')">
 

  
    <main class="py-16 px-4 bg-black text-white min-h-screen" style="background-image: url('/images/sfondo.PNG')"
            x-data="{ selected: null }">
        <h2 class="text-3xl font-bold text-center mb-12 text-white">Choose Your Package</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          @foreach(config('pacchetti') as $codice => $pacchetto)
          <div @click="selected = '{{ $codice }}'"
              :class="selected === '{{ $codice }}' ? 'ring ring-purple-300' : ''"
              class="package bg-black text-white border-2 border-purple-500 shadow-md rounded-lg p-6 text-center cursor-pointer transition">
            <h3 class="text-3xl font-semibold mb-4 border-b border-purple-500 pb-2">{{ $pacchetto['name'] }}</h3>
            
            <div class="h-6"></div>
            @foreach ($pacchetto['description_lines'] as $line)
            <li class="flex items-start gap-2 text-gray-300">
                <span class="text-purple-500">&gt;</span>
                <span class="text-lg">{{ $line }}</span>
            </li>
             @endforeach 

             <div class="h-6"></div>

            

            <p class="text-2xl font-bold mb-4 border-b border-purple-500 pb-2">€{{ number_format($pacchetto['price'], 2, ',', '.') }}</p>

          
          <button
            class="create-btn inline-block px-8 py-3 bg-black text-white font-bold text-lg border-4 border-purple-500 rounded-full hover:bg-purple-500 transition loader-link"
            @click.stop="
              selected = '{{ $codice }}';
              window.location.href = '{{ Auth::check() ? url('/crea-libro?pack=' . $codice) : route('auth.google') }}'
            ">
            Create
          </button>

          </div>
          @endforeach
        </div>
      </main>
  </div>
</x-app-layout> 

