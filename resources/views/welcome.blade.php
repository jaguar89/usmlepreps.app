@extends('app')

@push('css')
    <style>


    </style>
@endpush

@section('content')

    <div class="space-y-10 w-full bg-slate-100 p-8 rounded-b-lg shadow-md text-center border-t">
        @guest
            <div>
                <h2 class="text-2xl font-semibold mb-4">Signup now to track your progress!</h2>
                <p class="text-gray-600">Join us and take control of your journey.</p>
                <a href="{{ route('register') }}"
                   class="mt-4 px-6 py-2 bg-teal-500 text-white rounded-full hover:bg-teal-600 inline-block">Get
                    Started</a>
            </div>
        @endguest
        <!-- Content -->
        <div class="container mx-auto   grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <!-- Existing looped cards -->

            <!-- New cards with statistics -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Total Users</h2>
                <p class="text-gray-700 text-3xl font-bold">2350</p>
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Total Systems</h2>
                <p class="text-gray-700 text-3xl font-bold">120</p>
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Total Tasks</h2>
                <p class="text-gray-700 text-3xl font-bold">550</p>
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Total Videos</h2>
                <p class="text-gray-700 text-3xl font-bold">780</p>
            </div>
        </div>
    </div>


    <!-- Content -->
    <div
        class="container mx-auto p-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
    >
        <!-- Loop through each card -->
        @foreach($systemObjects as $systemObject)
            @auth()
                @php
                    // Calculate the total number of tests for this system object
                    $totalTests = $systemObject->tests->count();

                    // Calculate the number of completed tests for this user within this system object
                    $completedTests = auth()->user()->tests()->wherePivot('completed', true)->whereIn('test_id', $systemObject->tests->pluck('id'))->count();

                    // Calculate the completion percentage
                    $completionPercentage = $totalTests ? ($completedTests / $totalTests) * 100 : 0;
                @endphp
            @endauth
            <div class="bg-white p-4 shadow rounded">
                @if($systemObject->image_path)
                    <img
                        src="{{ asset('storage/' . $systemObject->image_path) }}"
                        alt="College Category"
                        class="w-full h-40 object-cover"
                    />
                @else
                    <span class="fas fa-graduation-cap w-full h-40 text-center text-gray-600"
                          style="font-size:9rem"></span> <!-- Default book icon -->
                @endif

                <h2 class="text-lg font-semibold mt-2">{{ $systemObject->name }}</h2>

                @auth()
                    <!-- Progress Bar -->
                    <div class="relative pt-1 mt-2">
                        <div class="flex mb-2 items-center justify-between">
                        <span
                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                            {{ number_format($completionPercentage, 2) }}% Complete
                      </span>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                            <div style="width:{{ $completionPercentage }}%"
                                 class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                        </div>
                    </div>
                @endauth
                <a
                    href="{{url('/view_tests/'. $systemObject->id)}}"
                    class="bg-green-500 text-white font-bold py-2 px-4 mt-4 block text-center rounded hover:bg-green-400"
                >View More</a
                >
            </div>
        @endforeach

        <!-- Render pagination links -->
        <div class="mt-4">
            {{ $systemObjects->links() }}
        </div>
    </div>

@endsection
