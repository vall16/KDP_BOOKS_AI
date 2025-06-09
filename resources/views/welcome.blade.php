<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KDP Books AI</title>


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                    <!-- /auth/google?next_action=login-only -->
                        
                        <a href="{{ route('auth.google', ['next_action' => 'login-only']) }}">
                            Login con Google 
                        </a>


                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                
                    <div class="text-sm leading-relaxed flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0_0_0_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0_0_0_1px_#fffaed2d] rounded-bl-2xl rounded-br-2xl lg:rounded-tl-2xl lg:rounded-br-none transition-all duration-300">
                    <h1 class="mb-3 text-2xl font-semibold text-[#1c1c1b] dark:text-white tracking-tight">🚀 KDP Books AI</h1>
                    <p class="mb-4 text-[#4a4a49] dark:text-[#B0AFA9] text-base leading-7">
                        <strong class="text-[#1c1c1b] dark:text-[#F5F5F5]">La piattaforma intelligente</strong> per creare, impaginare e pubblicare libri in pochi minuti.
                        <br class="hidden md:block">
                        Grazie all'<span class="font-semibold text-[#d97706] dark:text-[#facc15]">AI generativa</span>, puoi trasformare idee in contenuti pronti per <strong>KDP Amazon</strong>, senza competenze tecniche.
                    </p>         
                    <br>
                    <ul class="flex gap-3 text-sm leading-normal">
                        <li>
                            <a href="{{ url('/sell') }}"  class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">
                                Sell Page
                            </a>
                        </li>
                    </ul>
                </div>
                

                <div class="bg-[#fff2f2] dark:bg-[#1D0002] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg w-full lg:w-[438px] shrink-0 overflow-hidden h-72">

                        <img src="{{ asset('images/book.jpeg') }}" alt="book" class="w-full h-full object-cover block">
                </div>

            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
