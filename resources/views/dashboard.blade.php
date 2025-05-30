
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
                                            @if ($book['ready'] && $book['filename'])
                                                <a href="https://api.vibesrl.com/storage/generated_books/{{ $book['filename'] }}" class="text-blue-500 underline" target="_blank">Scarica PDF</a>
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

