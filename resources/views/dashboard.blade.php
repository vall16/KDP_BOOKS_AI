
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">Benvenuto {{ $user->name }} ({{ $user->email }})</h2>

                    <h3 class="text-lg font-semibold mb-2">I tuoi libri</h3>

                    @if(count($books))
                        <table class="min-w-full text-sm table-auto bg-white dark:bg-gray-800">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2">Titolo</th>
                                    <th class="px-4 py-2">Autore</th>
                                    <th class="px-4 py-2">Lingua</th>
                                    <th class="px-4 py-2">PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr class="border-t dark:border-gray-600">
                                        <td class="px-4 py-2">{{ $book['book_title'] }}</td>
                                        <td class="px-4 py-2">{{ $book['author_name'] }}</td>
                                        <td class="px-4 py-2">{{ $book['book_language'] }}</td>
                                        <td class="px-4 py-2">
                                            @if ($book['processed'] && $book['filename'])
                                                
                                                <!-- <a href="{{ url('/download-book/' . $book['id']) }}" target="_blank">Scarica PDF</a> -->
                                                <a href="{{ url('/download-book/' . $book['id']) }}" target="_blank" title="Scarica PDF">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 hover:text-red-800" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M6 2a2 2 0 0 0-2 2v16c0 1.103.897 2 2 2h12a2 2 0 0 0 2-2V8.414A1.99 1.99 0 0 0 19.586 7L15 2.414A1.99 1.99 0 0 0 13.586 2H6zm7 1.414L18.586 9H14a1 1 0 0 1-1-1V3.414zM8 13h1.5a1.5 1.5 0 0 1 0 3H8v-3zm3 0h1v3h-1v-3zm2.5 0H15a1 1 0 0 1 0 2h-1v1h-1.5v-3z"/>
                                                    </svg>
                                                </a>
                                            @else
                                                Non pronto
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mt-4 text-gray-500">Nessun libro trovato.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

