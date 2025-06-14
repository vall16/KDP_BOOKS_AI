<x-app-layout>
    <div class="py-12" x-data="bookModal()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-4">  👋 Welcome back {{ $user->name }} ({{ $user->email }}) !</h2>
                    <!-- <h3 class="text-lg font-semibold mb-4">Your books</h3> -->
                    <div class="max-w-5xl mx-auto mb-4">
                        <h3 class="text-lg font-semibold">Your books</h3>
                    </div>

                    @if(count($books))
                        <div class="flex justify-center">
                            

                            <table class="w-full max-w-5xl text-sm table-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                                    <tr>
                                        

                                        <th class="px-6 py-3 text-left">Title</th>
                                        <th class="px-6 py-3 text-left">Author</th>
                                        <th class="px-6 py-3 text-left">Language</th>
                                        <th class="px-6 py-3 text-left">PDF</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr class="border-t dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td @click="fetchDetails({{ $book['id'] }})"
                                                class="px-6 py-4 cursor-pointer text-blue-600 hover:underline">
                                                {{ $book['book_title'] }}
                                            </td>
                                            <td class="px-6 py-4">{{ $book['author_name'] }}</td>
                                            <td class="px-6 py-4">{{ $book['book_language'] }}</td>
                                            <td class="px-6 py-4">
                                                @if ($book['processed'] && $book['filename'])
                                                    <a href="{{ url('/download-book/' . $book['id']) }}" target="_blank" title="Scarica PDF">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 hover:text-red-800" viewBox="0 0 24 24" fill="currentColor">
                                                            <path d="M6 2a2 2 0 0 0-2 2v16c0 1.103.897 2 2 2h12a2 2 0 0 0 2-2V8.414A1.99 1.99 0 0 0 19.586 7L15 2.414A1.99 1.99 0 0 0 13.586 2H6zm7 1.414L18.586 9H14a1 1 0 0 1-1-1V3.414zM8 13h1.5a1.5 1.5 0 0 1 0 3H8v-3zm3 0h1v3h-1v-3zm2.5 0H15a1 1 0 0 1 0 2h-1v1h-1.5v-3z"/>
                                                        </svg>
                                                    </a>
                                                @else
                                                    Not Ready
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal popup -->
                        <div 
                            x-show="open" 
                            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
                            x-transition
                            style="display: none;"
                            @click="open = false"
                        >
                            <div class="bg-white p-6 rounded shadow-lg max-w-lg w-full relative">
                                <button @click="open = false" class="absolute top-2 right-2 text-gray-700 font-bold text-xl">&times;</button>
                                <template x-if="details">
                                    <div>
                                      
                                        <p><strong>Description:</strong> <span x-text="details.book_description"></span></p>
                                        <p><strong>Minimum chapters:</strong> <span x-text="details.min_chapters"></span></p>
                                        <p><strong>Minimum words per chapter:</strong> <span x-text="details.min_words_per_chapter"></span></p>
                                        <p><strong>Processed:</strong> <span x-text="details.processed ? 'Yes' : 'No'"></span></p>
                                        <p><strong>Ready:</strong> <span x-text="details.ready ? 'Yes' : 'No'"></span></p>
                                        <p><strong>Sent:</strong> <span x-text="details.sent ? 'Yes' : 'No'"></span></p>
                                        <p><strong>Filename:</strong> <span x-text="details.filename"></span></p>
                                        <p><strong>Creation date:</strong> <span x-text="new Date(details.created_at).toLocaleString()"></span></p>
                                        <p><strong>Referrer IP:</strong> <span x-text="details.referrer_ip"></span></p>
                                        <p><strong>User email:</strong> <span x-text="details.user_email"></span></p>
                                        <p><strong>Book ID:</strong> <span x-text="details.id"></span></p>
                                        <p><strong>User ID:</strong> <span x-text="details.user_id"></span></p>
                                        <p><strong>Error message:</strong> <span x-text="details.error_message || 'None'"></span></p>

                                    </div>
                                </template>
                                <template x-if="!details">
                                    <p>Loading details...</p>
                                </template>
                            </div>
                        </div>
                    @else
                        <p class="mt-4 text-gray-500">Books not found.</p>
                    @endif
                </div>
            </div>
        </div>

        <script>
            function bookModal() {
                return {
                    open: false,
                    details: null,
                    fetchDetails(id) {
                        this.open = true;
                        this.details = null;
                        fetch(`/api/books/${id}`)
                            .then(res => res.json())
                            .then(data => {
                                this.details = data;
                            })
                            .catch(() => {
                                this.details = { book_title: 'Errore in loading', author_name: '', book_language: '' };
                            });
                    }
                }
            }
        </script>
    </div>
</x-app-layout>
