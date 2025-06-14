
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
    <h1 class="text-2xl font-bold mb-6">📚 Book Creation</h1>

    <p class="mb-6">
      You have selected the <strong>Package: {{ $pacchetto['name'] }}</strong> <br>
      Price: <strong>€{{ number_format($pacchetto['price'], 2, ',', '.') }}</strong>
    </p>

    <form method="POST" action="{{ route('book.startCheckout') }}">
  @csrf

  <input type="hidden" name="pack" value="{{ $packCode }}">

  <div class="space-y-6">
    <!-- User Email -->
    <div>
        <!-- se sono loggato la mail è fissa forzata (è l'id) -->
      <label for="user_email" class="block mb-1 font-semibold">User Email</label>
      <!-- <input type="email" id="user_email" name="user_email" class="w-full border rounded p-2" value="{{ Auth::check() ? Auth::user()->email : '' }}" required /> -->
        <input
        type="email"
        id="user_email"
        name="user_email"
        class="w-full border rounded p-2"
        
        value="{{ Auth::check() ? Auth::user()->email : '' }}"
        {{ Auth::check() ? 'readonly' : '' }}
        required

    />
    

    </div>

    <!-- Author Name -->
    <div>
      <label for="author_name" class="block mb-1 font-semibold">Author Name</label>
      <input type="text" id="author_name" name="author_name" class="w-full border rounded p-2" required />
    </div>

    <!-- Book Title -->
    <div>
      <label for="book_title" class="block mb-1 font-semibold">Book Title</label>
      <input type="text" id="book_title" name="book_title" class="w-full border rounded p-2" required />
    </div>

    <!-- Description -->
    <div>
      <label for="book_description" class="block mb-1 font-semibold">Description / Ideas</label>
      <textarea id="book_description" name="book_description" rows="4" class="w-full border rounded p-2" required minlength="10"></textarea>
    </div>

    <!-- Language -->
    <div>
      <label for="book_language" class="block mb-1 font-semibold">Language</label>
      <select id="book_language" name="book_language" class="w-full border rounded p-2" required>
        <option value="">-- Select --</option>
        <option value="ENGLISH">English</option>
        <option value="ITALIAN">Italiano</option>
        <option value="FRENCH">Français</option>
        <option value="SPANISH">Español</option>
        <option value="GERMAN">Deutsch</option>
      </select>
    </div>

    <!-- Min Chapters -->
    <div>
      <label for="min_chapters" class="block mb-1 font-semibold">Min. Chapters</label>
      <input type="number" id="min_chapters" name="min_chapters" class="w-full border rounded p-2"
        min="{{ $pacchetto['chapters'] }}"
        value="{{ $pacchetto['chapters'] }}" required />
    </div>

    <!-- Min Words per Chapter -->
    <div>
      <label for="min_words_per_chapter" class="block mb-1 font-semibold">Min. Words / Chapter</label>
      <input type="number" id="min_words_per_chapter" name="min_words_per_chapter" class="w-full border rounded p-2"
        min="{{ $pacchetto['words_per_chapter'] }}"
        value="{{ $pacchetto['words_per_chapter'] }}" required />
    </div>
  </div>

  <!-- Submit Button -->
  <div class="mt-6">
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
      Purchase and Generate Book
    </button>
  </div>
</form>

  </div>
</x-app-layout>
```

