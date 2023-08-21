@extends('app')

@push('css')

    <style>
        p a {
            color: blue !important; /* Sets the color of the link text to blue */
            text-decoration: underline !important; /* Underlines the link text */
            display: inline-block; /* Allows overflow to be hidden */
            max-width: 100%; /* Ensures link doesn't exceed container's width */
            overflow: hidden; /* Hides overflow */
            text-overflow: ellipsis; /* Adds ellipsis if text overflows */
            white-space: nowrap; /* Prevents the text from wrapping onto the next line */
        }

    </style>
@endpush

@section('content')

    <!-- Flash messages section -->
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mt-4 mb-1 rounded relative alert"
             role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="closeErrorMessage()">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 5.354 4.647a.5.5 0 1 0-.707.707L9.293 10l-4.646 4.646a.5.5 0 0 0 .707.707L10 10.707l4.646 4.646a.5.5 0 0 0 .707-.707L10.707 10l4.646-4.646a.5.5 0 0 0 0-.707z"/>
            </svg>
        </span>
        </div>
    @endif

    <div class="container mx-auto p-4 bg-white shadow rounded mt-2 mb-4" id="title">
        <div
            class="flex flex-col sm:flex-row  justify-between cursor-pointer mt-3"

        >
            <h1
                class="text-xl font-bold text-gray-600 flex flex-row items-center"
            >
                <!-- Your existing SVG and other content -->
                &nbsp {{$test->system->name}}
            </h1>

            <span id="icon" class="hidden sm:block arrow-down"></span>
        </div>

        <div id="section" class="flex flex-col space-y-4">
            <div class="flex flex-col  justify-between items-end space-y-2">
                <div class="w-full p-3 bg-gray-200 rounded">
                    <p class="text-xs sm:text-sm">
                        Task Title: {{$test->title}}
                    </p>
                </div>


                @auth()
                    @if(!auth()->user()->isAdmin() && !auth()->user()->tests()->where('test_id',$test->id)->wherePivot('completed', true)->exists())
                        <button
                            onclick="completeTest({{$test->system_id}},{{$test->id}},{{auth()->user()->id}})"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded-full text-xs ml-auto flex items-center"
                        >
                            <i class="fas fa-check mr-1"></i>
                            Mark as complete
                        </button>

                    @elseif(!auth()->user()->isAdmin())
                        <div class="flex flex-row space-x-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            <button
                                onclick="incompleteTest({{$test->system_id}},{{$test->id}},{{auth()->user()->id}})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded-full text-xs ml-auto flex items-center"
                            >
                                <i class="fas fa-times mr-1"></i>
                                Incomplete Task
                            </button>

                        </div>
                    @endif
                @endauth
            </div>
            <p class="mt-0 text-sm sm:text-base break-all overflow-hidden content-paragraph">
                {!! $test->content !!}
            </p>
            <div
                class="flex flex-col space-y-2 sm:space-y-0 sm:flex-row justify-between"
            >
                <a
                    onclick="createTestOnUsmlepreps({ ids: {{ json_encode( $test->questions_ids) }} })"
                    class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded text-sm sm:text-base"
                >Create test on Usmlepreps</a
                >
                <a
                    href="{{ route('download.material', ['test' => $test]) }}"
                    class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded text-sm sm:text-base flex items-center justify-center"
                >
                    <i class="fas fa-download mr-2"></i> View Materials
                </a>
            </div>
        </div>
    </div>
    <input type="hidden" name="request_api_url" id="request_api_url" value="{{env('REQUEST_USMLEPREPS_API_URL')}}">
@endsection

@push('script')
    <!-- JavaScript code to handle expandable sections -->
    <script>
        function completeTest(systemId, testId, userId) {
            // URL where you'll send the POST request
            const url = `/complete-test/${testId}`;

            // POST data
            const data = {
                test_id: testId,
                user_id: userId,
                system_id: systemId
                // any other data you want to send
            };

            // Fetch options
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Include CSRF token if you're using Laravel
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(data),
            };

            // Make the request
            fetch(url, options)
                .then(response => response.json())
                .then(data => {
                    // Handle success
                    // For example, update the UI or show a success message
                    console.log('Test marked as complete', data);
                    location.reload();
                })
                .catch(error => {
                    // Handle error
                    console.error('An error occurred while marking the test as complete', error);
                });
        }

        function incompleteTest(systemId, testId, userId) {
            const url = `/incomplete-test/${testId}`;

            // POST data
            const data = {
                test_id: testId,
                user_id: userId,
                system_id: systemId
                // any other data you want to send
            };

            // Fetch options
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Include CSRF token if you're using Laravel
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(data),
            };

            fetch(url, options)
                .then(response => response.json())
                .then(data => {
                    console.log('Test marked as incomplete', data);
                    location.reload();
                })
                .catch(error => {
                    // Handle error
                    console.error('An error occurred while marking the test as complete', error);
                });
        }

        <!-- Head content here -->
        function closeErrorMessage() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }

        function createTestOnUsmlepreps(data) {
            const url = document.getElementById('request_api_url').value;
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Include CSRF token if you're using Laravel
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(data),
            };
            fetch(url, options)
                .then(response => response.json())
                .then(data => {
                    console.log('I got a response with : ', data);
                    location.href = data.url;
                })
                .catch(error => {
                    // Handle error
                    console.error('An error occurred while marking the test as complete', error);
                });
        }


    </script>

@endpush
