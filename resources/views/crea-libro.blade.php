<x-app-layout>
  @if (session('success'))
    <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-300">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-300">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <div class="max-w-6xl mx-auto mt-12 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">📚 Creazione Libro</h1>

    <p class="mb-6">
      Hai scelto il <strong>Pacchetto: {{ ucfirst($pack) }}</strong>
    </p>

    <form method="POST" action="{{ route('book.generate') }}">
      @csrf
      <input type="hidden" name="pack" value="{{ $pack }}" />

      <!-- Prima riga di campi -->
      <div class="flex flex-wrap -mx-3 mb-4">
        <div class="w-full sm:w-1/3 px-3 mb-4 sm:mb-0">
          <label for="user_email" class="block mb-1 font-semibold">Email Utente</label>
          <input type="email" id="user_email" name="user_email" class="w-full border rounded p-2" required />
        </div>

        <div class="w-full sm:w-1/3 px-3 mb-4 sm:mb-0">
          <label for="author_name" class="block mb-1 font-semibold">Nome Autore</label>
          <input type="text" id="author_name" name="author_name" class="w-full border rounded p-2" required />
        </div>

        <div class="w-full sm:w-1/3 px-3">
          <label for="book_title" class="block mb-1 font-semibold">Titolo del Libro</label>
          <input type="text" id="book_title" name="book_title" class="w-full border rounded p-2" required />
        </div>
      </div>

      <!-- Seconda riga di campi -->
      <div class="flex flex-wrap -mx-3 mb-4">
        <div class="w-full sm:w-1/2 px-3 mb-4 sm:mb-0">
          <label for="book_description" class="block mb-1 font-semibold">Descrizione / Idee</label>
          <textarea id="book_description" name="book_description" rows="4" class="w-full border rounded p-2" required></textarea>
        </div>

        <div class="w-full sm:w-1/6 px-3 mb-4 sm:mb-0">
          <label for="book_language" class="block mb-1 font-semibold">Lingua</label>
          <input type="text" id="book_language" name="book_language" class="w-full border rounded p-2" required />
        </div>

        <div class="w-full sm:w-1/6 px-3 mb-4 sm:mb-0">
          <label for="min_chapters" class="block mb-1 font-semibold">Min. Capitoli</label>
          <input type="number" id="min_chapters" name="min_chapters" class="w-full border rounded p-2" min="1" required />
        </div>

        <div class="w-full sm:w-1/6 px-3">
          <label for="min_words_per_chapter" class="block mb-1 font-semibold">Min. Parole / Capitolo</label>
          <input type="number" id="min_words_per_chapter" name="min_words_per_chapter" class="w-full border rounded p-2" min="1" required />
        </div>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Genera Libro
      </button>
    </form>
  </div>
</x-app-layout>
