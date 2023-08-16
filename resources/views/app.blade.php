<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    @vite('resources/css/app.css')
    @stack('css')
</head>
<body class="">

<nav class="bg-teal-600 p-4">
    <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between">
        <a
            href="{{url('/')}}"
            class="text-white text-2xl font-bold flex flex-row items-center"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"
                />
            </svg
            >
            &nbsp
            <!-- <img src="logo.png" alt="Logo" class="h-10 inline-block mr-2" />  -->
            Usmlepreps
        </a>
        <!-- Add other navigation links if needed -->
        <div
            class="flex justify-center sm:items-center text-white">
            @if (Route::has('login'))
                <div>
                    @auth
                        @if(auth()->user()->isAdmin())
                        <a href="{{ url('/dashboard') }}"
                           class="font-semibold  hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <span class="mr-4">Welcome, {{ Auth::user()->name }}!</span>
                            <a href="{{ route('logout') }}"
                               class="text-red-400 hover:text-red-600"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="font-semibold  hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 font-semibold  hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>


@yield('content')



<!-- Footer -->
<footer class="bg-teal-600 text-white p-4 mt-8">
    <div class="container mx-auto text-center">
        &copy; 2023 Usmlepreps. All rights reserved.
    </div>
</footer>
@stack('script')
</body>
</html>

