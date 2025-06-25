<!-- è la navbar di breeze -->
<nav
    x-data="{ open: false }"

    class="bg-black text-white fixed top-0 left-0 w-full z-50 border-b border-gray-700">


    


@php
    $dashboardUrl = Auth::check()
        ? route('dashboard')
        : route('auth.google', ['next_action' => 'dashboard']);
@endphp

<!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16 ">
            <div class="flex">
                <!-- Logo -->
                
                <!-- <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center gap-2 text-white text-2xl font-extrabold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 4v16c0 .55.45 1 1 1s1-.45 1-1V5h11V4H6zm3 4v12c0 .55.45 1 1 1s1-.45 1-1V8H9zm4 4v8c0 .55.45 1 1 1s1-.45 1-1v-8h-2zm4 4v4c0 .55.45 1 1 1s1-.45 1-1v-4h-2z"/>
                        </svg>
                        <span>EASY BOOKS AI</span>
                    </a>
                </div> -->

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center gap-2 text-white text-2xl font-extrabold">
                        <img src="{{ asset('images/easybookai_logo.ico') }}" alt="EasyBookAI Logo" class="h-10 w-auto">
                        <span>EASY BOOKS AI</span>
                    </a>
                </div>
                

                <!-- Navigation Links ... se si è sulla pagina, sono evidenziati-->
                <div class="hidden space-x-8 sm:-my-px sm:ms-24 sm:flex ">
                    
                    <x-nav-link :href="$dashboardUrl" :active="request()->routeIs('dashboard')" class="loader-link">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('sell')" :active="request()->routeIs('sell')" class="loader-link">
                        {{ __('Sell Page') }}
                    </x-nav-link>
                </div>

                <!-- condizioni di vendita ... -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('condizioni')" :active="request()->routeIs('condizioni')" class="loader-link">
                        {{ __('Terms & Conditions') }}
                    </x-nav-link>
                </div>

                
                
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @auth
                <!-- Authenticated Dropdown -->

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

                    <x-slot name="content" >
                        
                        

                        <x-dropdown-link :href="route('profile.edit')"
                            class="bg-black text-white hover:bg-gray-800 hover:text-purple-400 focus:outline-none focus:ring-0 focus:ring-offset-0">
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        <!-- Authentication -->
                         <form method="POST" action="{{ route('logout') }}">
                            @csrf 

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="bg-black text-white hover:bg-gray-800 hover:text-purple-400 focus:outline-none focus:ring-0 focus:ring-offset-0">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                        
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu: Contiene link analoghi a quelli desktop, ma pensati per dispositivi mobili -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
         @auth

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            

        <div class="px-4">
        <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-purple-300">{{ Auth::user()->email }}</div>
    </div>


            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth

    </div>
</nav>
