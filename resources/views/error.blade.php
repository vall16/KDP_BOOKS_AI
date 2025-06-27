<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-black text-white">
        <div class="text-center max-w-xl">
            <h1 class="text-2xl font-bold text-red-600 mb-4">❌ An error has occurred</h1>
            <!-- <p class="text-white mb-6">
                {{ session('message') ?? 'Error unknown.' }}
            </p> -->
            <p class="text-white mb-6 whitespace-pre-line">
                {!! nl2br(e(session('message') ?? 'Error unknown.')) !!}
            </p>

            <a href="{{ route('sell') }}" class="inline-block bg-white text-black px-6 py-2 rounded hover:bg-gray-300 transition">
                Back to Sell Page
            </a>
        </div>
    </div>
</x-app-layout>

