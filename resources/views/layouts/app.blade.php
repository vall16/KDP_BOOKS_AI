
<!DOCTYPE html>
<!-- È un layout Blade, ovvero uno scheletro HTML comune a tutte le pagine. -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'xxx') }}</title>

        <!-- ✅ Favicon -->
        <link rel="icon" href="{{ asset('images/easybookai_logo.ico') }}" type="image/png">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    

    <!-- // il body di tutte le pagine è nero  -->
    <body class="font-sans antialiased bg-black text-white" style="background-image: url('/images/sfondo.PNG')">
        

            @include('layouts.navigation')

            <div class="pt-16" style="background-image: url('/images/sfondo.PNG')"> 
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
            <footer class="bg-black text-white text-left py-6 px-4 text-sm border-t">
                    &copy; 2025 Vibe srl. | All Rights Reserved
            </footer>



        <!-- </div> -->
        <!-- @stack('scripts') {{-- NECESSARIO per @push funzionare --}} -->

         <!-- Fullscreen Loader Overlay -->
        <div id="global-loader" class="fixed inset-0 bg-black bg-opacity-100 flex items-center justify-center z-50 hidden">
            <svg class="animate-spin h-20 w-20 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
            </svg>
        </div>
        <!-- <script>
            document.addEventListener("DOMContentLoaded", () => {
                const loader = document.getElementById('global-loader');

                // Per ogni link <a> con classe loader-link
                document.querySelectorAll('a.loader-link, button.loader-link').forEach(el => {
                    el.addEventListener('click', e => {
                        const href = el.getAttribute('href');

                        if (href && href.startsWith('#')) return; // ignora anchor link

                        e.preventDefault();  // Blocca la navigazione immediata!


                        // Mostra loader
                        loader.classList.remove('hidden');

                        // Per evitare che il loader si chiuda troppo in fretta
                        setTimeout(() => {
                            // Se è un <a> con href, naviga dopo un attimo
                            if (el.tagName === 'A' && href) {
                                window.location.href = href;
                            }
                        }, 500); // mezzo secondo
                    });
                });
            });
        </script> -->


    </body>
</html>

