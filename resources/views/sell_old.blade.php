<x-app-layout>
  <main class="max-w-5xl mx-auto py-16 px-4 bg-gray-50 min-h-screen">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Scegli il tuo pacchetto</h2>

    <div id="package-container" class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach([
        ['nome' => 'Base', 'descrizione' => '1 libro, copertina semplice', 'prezzo' => '€9,99'],
        ['nome' => 'Plus', 'descrizione' => '3 libri, copertine HD', 'prezzo' => '€24,99'],
        ['nome' => 'Premium', 'descrizione' => '10 libri, AI avanzata + copertine HD', 'prezzo' => '€59,99'],
      ] as $pacchetto)
        <div class="package bg-white shadow-md rounded-lg p-6 text-center cursor-pointer transition border-2 border-transparent">
          <h3 class="text-xl font-semibold mb-4">Pacchetto {{ $pacchetto['nome'] }}</h3>
          <p class="text-gray-600 mb-4">{{ $pacchetto['descrizione'] }}</p>
          <p class="text-2xl font-bold mb-4">{{ $pacchetto['prezzo'] }}</p>
          <button disabled class="create-btn inline-block px-6 py-2 bg-blue-600 text-white rounded opacity-50 cursor-not-allowed">Crea</button>
        </div>
      @endforeach
    </div>
  </main>

  @push('scripts')
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.package').forEach(pkg => {
      const createBtn = pkg.querySelector('.create-btn');
      createBtn.disabled = true;
      createBtn.classList.add('opacity-50', 'cursor-not-allowed');

      pkg.addEventListener('click', () => {
        document.querySelectorAll('.package').forEach(p => {
          p.classList.remove('border-blue-600', 'ring', 'ring-blue-300');
          const btn = p.querySelector('.create-btn');
          btn.disabled = true;
          btn.classList.add('opacity-50', 'cursor-not-allowed');
        });

        pkg.classList.add('border-blue-600', 'ring', 'ring-blue-300');
        createBtn.disabled = false;
        createBtn.classList.remove('opacity-50', 'cursor-not-allowed');
      });

      createBtn.addEventListener('click', e => {
        e.stopPropagation();
        if (!createBtn.disabled) {
          const name = pkg.querySelector('h3').textContent.trim().toLowerCase().replace('pacchetto ', '');
          window.location.href = `/crea-libro?pack=${name}`;
        }
      });
    });
  });
</script>
@
  @endpush
</x-app-layout>
