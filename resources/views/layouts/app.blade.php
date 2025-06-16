
<!DOCTYPE html>
<!-- È un layout Blade, ovvero uno scheletro HTML comune a tutte le pagine. -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'xxx') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    

    <!-- // il body di tutte le pagine è nero  -->
    <body class="font-sans antialiased bg-black text-white">
        

            @include('layouts.navigation')

            <div class="pt-16"> 
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
         <footer class="bg-black text-white text-left py-6 px-4 text-sm border-t
">
  &copy; 2025 Vibe srl. | All Rights Reserved


</footer>



        </div>
        <!-- @stack('scripts') {{-- NECESSARIO per @push funzionare --}} -->
    </body>
</html>

<script>
    // spinner 
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.loader-link').forEach(link => {
            link.addEventListener('click', (e) => {
                // Mostra loader
                const text = link.querySelector('.link-text');
                const spinner = link.querySelector('.loader-spinner');

                if (text && spinner) {
                    text.classList.add('opacity-50');
                    spinner.classList.remove('hidden');
                }

                // Disabilita clic ulteriori
                link.style.pointerEvents = 'none';
            });
        });
    });
</script>

