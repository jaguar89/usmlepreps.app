<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Usmle Materials</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700"
        rel="stylesheet"
    />

    @vite('resources/css/app.css')
    @stack('css')
</head>
<body class="bg-gray-200">

<nav class="flex flex-col sm:flex-row justify-between bg-teal-600 p-4 px-10">
{{--    <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between">--}}
      <div  class="flex flex-row justify-between">
          <a href="{{url('/')}}" class="font-source-sans-pro text-white text-2xl lg:text-4xl font-bold flex flex-row items-center font">
              <svg
                  class="h-8 fill-current inline"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
              >
                  <path d="M0 0h24v24H0z" fill="none" />
                  <path
                      d="M18 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm0 18H6V4h2v8l2.5-1.5L13 12V4h5v16z"
                  />
              </svg>
              Usmle Materials
          </a>
          <!-- Hamburger button, visible only on mobile -->
          <button class="sm:hidden p-2 focus:outline-none" id="menu-toggle">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                   stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16m-7 6h7"></path>
              </svg>
          </button>
      </div>
        <!-- Navigation links, hidden on mobile by default -->
        <div class="flex justify-center sm:items-center text-white hidden sm:flex" id="menu-links">
            @if (Route::has('login'))
                <div>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ url('/dashboard') }}"
                               class="font-semibold  hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <span class="mr-4">Welcome, {{ Auth::user()->name }}!</span>
{{--                            <a href="{{ route('view.videos') }}"--}}
{{--                               class="py-2 px-4 bg-amber-400 text-white rounded-full hover:bg-amber-600 inline-block">--}}
{{--                                Browse All Videos!--}}
{{--                            </a>--}}
                            <a href="{{ route('logout') }}"
                               class="text-gray-100 bg-red-400 hover:bg-red-600 transition-all duration-300 ease-in-out py-2 px-4 rounded-full inline-flex items-center"
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
</nav>


@yield('content')



<!-- Footer -->
<footer class="bg-teal-600 text-white p-4 mt-8">
    <div class="container mx-auto text-center">
        &copy; 2023 Usmle Materials. All rights reserved.
    </div>
</footer>
@stack('script')
<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        var menuLinks = document.getElementById('menu-links');
        menuLinks.classList.toggle('hidden');
        menuLinks.classList.toggle('sm:flex');
    });
</script>

</body>
</html>

