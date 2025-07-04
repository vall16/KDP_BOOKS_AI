<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Easy Books AI</title>

        <!-- ✅ Favicon -->
        <link rel="icon" href="{{ asset('images/easybookai_logo.ico') }}" type="image/png">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="bg-black text-white flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                
                <nav class="flex items-center justify-between w-full">
                    

                    <div class="flex items-center gap-2 text-white text-2xl font-extrabold">
                        <img src="{{ asset('images/easybookai_logo.ico') }}" alt="EasyBookAI Logo" class="h-10">
                        EASY BOOKS AI
                    </div>

                    @auth
                        <!-- <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a> -->
                            <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-purple-500 text-sm leading-4 font-medium rounded-md text-white bg-black hover:bg-gray-900 hover:text-purple-400 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>
                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>

                        

                        
                    @else
                        <a href="{{ route('auth.google', ['next_action' => 'login-only']) }}"
                            class="loader-link inline-flex items-center px-4 py-2 bg-black text-white border border-purple-500 rounded shadow hover:bg-purple-800 hover:text-white transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#4285f4" d="M533.5 278.4c0-17.4-1.5-34.1-4.3-50.3H272v95.3h147.2c-6.3 33.9-25.1 62.6-53.4 81.9v68.2h86.3c50.6-46.6 81.4-115.3 81.4-195.1z"/>
                                <path fill="#34a853" d="M272 544.3c72.6 0 133.6-24.1 178.2-65.5l-86.3-68.2c-24 16.1-54.5 25.6-91.9 25.6-70.7 0-130.7-47.7-152.1-111.5H30.2v69.9C74.3 479.1 167.2 544.3 272 544.3z"/>
                                <path fill="#fbbc04" d="M119.9 324.7c-10.2-30-10.2-62.5 0-92.5v-69.9H30.2c-39.8 78.2-39.8 170.6 0 248.8l89.7-69.9z"/>
                                <path fill="#ea4335" d="M272 107.7c39.5-.6 77.4 14 106.3 41.2l79.5-79.5C428.7 24.7 352.3-1.5 272 0 167.2 0 74.3 65.2 30.2 162.3l89.7 69.9C141.3 155.4 201.3 107.7 272 107.7z"/>
                            </svg>
                            Login
                        </a>
                    @endauth
                </nav>

            @endif
        </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0" style="background-image: url('/images/sfondo.PNG')">
           
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row lg:h-auto items-start justify-start">

                <div class="text-sm leading-relaxed flex-1 p-4 pt-2 lg:pt-0 lg:pl-4 lg:pr-16 lg:pb-6 mt-4 lg:mt-12">


                    <p class="mb-6 text-white text-lg leading-relaxed font-light tracking-wide">
                        <span class="text-2xl font-extrabold text-purple-400 block mb-2">
                            Create your next bestseller in minutes
                        </span>
                        <span class="block mb-2">
                            <em class="text-sm text-gray-300">No writing skills required</em>
                        </span>
                        <span class="block">
                            With the power of <span class="font-semibold text-purple-400">generative AI</span>, 
                            <strong class="text-white">Easy Books AI</strong> helps you turn your raw ideas into polished, 
                            ready-to-publish books on <span class="font-semibold text-purple-400">Amazon KDP</span>.
                        </span>
                        <br class="hidden md:block">
                        <span class="block mt-3 text-gray-300">
                            Focus on your vision. 
                            <span class="text-white font-semibold">We’ll handle the words, formatting, and structure — instantly.</span>
                        </span>
                    </p>


                    <br>
                    <ul class="flex gap-3 text-sm leading-normal">
                        <li>
                            <a href="{{ url('/sell') }}" 
                            class="loader-link inline-block px-5 py-1.5 bg-black text-white border border-purple-500 hover:bg-purple-800 rounded-sm text-sm leading-normal">
                                Sell Page 
                            </a>
                        </li>
                    </ul>
                </div>

                

                <div class="bg-[#fff2f2] dark:bg-[#1D0002] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg w-full lg:w-[438px] shrink-0 overflow-hidden h-72 h-full">

                        <img src="{{ asset('images/book2.png') }}" alt="book" class="w-full h-full object-cover block">
                </div>
                <!-- Fullscreen Loader Overlay SPINNER-->
                <div id="global-loader" class="fixed inset-0 bg-black bg-opacity-100 flex items-center justify-center z-50 hidden">
                    <svg class="animate-spin h-20 w-20 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                    </svg>
                </div>

            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif


    </body>
    
    <footer class="bg-black text-white text-left py-6 px-4 text-sm border-t mt-8">

    
        &copy; 2025 Vibe srl. | All Rights Reserved.
    </footer>
</html>
