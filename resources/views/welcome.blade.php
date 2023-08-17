@extends('app')

@section('content')

    <!-- Content -->
    <div
        class="container mx-auto p-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8"
    >
        <!-- Loop through each card -->
        @foreach($systemObjects as $systemObject)
            @php
                // Calculate the total number of tests for this system object
                $totalTests = $systemObject->tests->count();

                // Calculate the number of completed tests for this user within this system object
                $completedTests = auth()->user()->tests()->wherePivot('completed', true)->whereIn('test_id', $systemObject->tests->pluck('id'))->count();

                // Calculate the completion percentage
                $completionPercentage = $totalTests ? ($completedTests / $totalTests) * 100 : 0;
            @endphp

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

                <a
                    href="{{url('/tests/'. $systemObject->id)}}"
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
