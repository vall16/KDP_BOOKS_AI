
<x-app-layout>
      <div class="flex items-center justify-center min-h-screen">
        <div class="text-center max-w-xl">
            <p class="lead mt-4">
                                 
            </p>
            <p class="lead mt-4">
                                      
            </p>
            

            <h1 class="text-success">✅ Payment completed successfully!!!</h1>
            <p class="lead mt-4">
                Thank you for your purchase! Your book is currently being generated.
            </p>

            <p class="mt-3">
                You will receive a notification via email (<strong>{{ auth()->user()->email }}</strong>) as soon as it's ready.
            </p>

            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-4">
                Go to your books
            </a>

        </div>
    </div>
</x-app-layout>




