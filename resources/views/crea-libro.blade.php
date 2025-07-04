<x-app-layout>
  @if (session('success'))
    <div class="mb-4 p-4 rounded bg-green-800 text-white border border-green-500"style="background-image: url('/images/sfondo.PNG')">
        {{ session('success') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="mb-4 p-4 rounded bg-red-800 text-white border border-red-500"style="background-image: url('/images/sfondo.PNG')">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <div class="max-w-6xl mx-auto mt-12 p-6 bg-black text-white rounded-lg shadow" >
    
    <h1 class="text-4xl font-bold mb-6">Book Creation</h1>

    <p class="mb-6">
      
      You have selected the Package: <strong class="text-purple-500"> {{ $pacchetto['name'] }}</strong> <br>
Price: <strong class="text-purple-500">€{{ number_format($pacchetto['price'], 2, ',', '.') }}</strong>

    </p>

    
    <form method="POST" action="{{ route('book.startCheckout') }}">
      @csrf
      <input type="hidden" name="pack" value="{{ $packCode }}">

      <div class="space-y-6">
        <!-- User Email -->
        <div>
          <label for="user_email" class="block mb-1 font-semibold input-purple">User Email</label>
          <input
            type="email"
            id="user_email"
            name="user_email"
            class="input-purple w-full border border-gray-600 rounded p-2 bg-black text-white"
            value="{{ Auth::check() ? Auth::user()->email : '' }}"
            {{ Auth::check() ? 'readonly' : '' }}
            required
            
          />
        </div>

        <div>
        <label for="author_name" class="block mb-1 font-semibold ">Author Name</label>
        <input type="text" id="author_name" name="author_name"
          class="input-purple w-full border border-gray-600 rounded p-2 bg-black text-white"
          value="{{ Auth::check() ? Auth::user()->name : '' }}"
          
          required
        />
        </div>


        <!-- Book Title -->
        <div>
          <label for="book_title" class="block mb-1 font-semibold">Book Title</label>
          <input type="text" id="book_title" name="book_title" class=" input-purple w-full border border-gray-600 rounded p-2 bg-black text-white" required />
        </div>

        <!-- Description -->
        <div>
          <label for="book_description" class="block mb-1 font-semibold">Description / Ideas</label>
          <textarea id="book_description" name="book_description" rows="4" class="input-purple w-full border border-gray-600 rounded p-2 bg-black text-white" required minlength="10"></textarea>
        </div>

        <!-- Language -->
        <div>
          <label for="book_language" class="block mb-1 font-semibold">Language</label>
          <select id="book_language" name="book_language" class=" input-purple w-full border border-gray-600 rounded p-2 bg-black text-white" required>
            <option value="">-- Select --</option>
            <option value="ENGLISH">English</option>
            <option value="ITALIAN">Italiano</option>
            <option value="FRENCH">Français</option>
            <option value="SPANISH">Español</option>
            <option value="GERMAN">Deutsch</option>
          </select>
        </div>

        <!-- Max Chapters -->
        <div>
          <label for="max_chapters" class="block mb-1 font-semibold">max. Chapters</label>
          <input type="number" id="min_chapters" name="min_chapters" class=" input-purple w-full border border-gray-600 rounded p-2 bg-black text-white"
            max="{{ $pacchetto['chapters'] }}"
            value="{{ $pacchetto['chapters'] }}" required />
        </div>

        <!-- min Words per Chapter -->
        <div>
          <label for="min_words_per_chapter" class="block mb-1 font-semibold">max. Words / Chapter</label>
          <input type="number" id="min_words_per_chapter" name="min_words_per_chapter" class=" input-purple w-full border border-gray-600 rounded p-2 bg-black text-white"
            max="{{ $pacchetto['words_per_chapter'] }}"
            value="{{ $pacchetto['words_per_chapter'] }}" required />
        </div>
      </div>

      <!-- Submit Button -->
      
        <div class="mt-6">
        <button type="submit" class="bg-black text-purple-500 border border-purple-500 px-6 py-2 rounded hover:bg-gray-800 transition">
        Purchase and Generate Book
        </button>
        </div>


      </div>
    </form>
  </div>
</x-app-layout>
