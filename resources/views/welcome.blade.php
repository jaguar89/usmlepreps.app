@extends('app')

@section('content')

    <!-- Content -->
    <div
        class="container mx-auto p-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8"
    >
        <!-- Loop through each card -->
        @foreach($systemObjects as $systemObject)
            <div class="bg-white p-4 shadow rounded">
                @if($systemObject->image_path)
                    <img
                        src="{{ asset('storage/' . $systemObject->image_path) }}"
                        alt="College Category"
                        class="w-full h-40 object-cover"
                    />
                @else
                    <span class="fas fa-graduation-cap w-full h-40 text-center text-gray-600" style="font-size:9rem"></span> <!-- Default book icon -->
                @endif

                <h2 class="text-lg font-semibold mt-2">{{ $systemObject->name }}</h2>
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
