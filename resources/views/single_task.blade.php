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
                <?php
                if (!function_exists('getVideoTitle')) {
                    function getVideoTitle($videoId) {
                        $video = \App\Models\Video::find($videoId);
                        return $video ? $video->title : 'Video not found';
                    }
                }
                $content = $test->content;

                $content = preg_replace_callback(
                    '/<span style="font-size: 18pt;"><strong><span style="color: rgb\(132, 63, 161\);"><a href="..\/..\/view-single-video\/(\d+)" target="_blank" rel="noopener">.*?<\/a><\/span><\/strong><\/span>/',
                    function ($matches) {
                        $videoId = $matches[1];
                        $videoTitle = getVideoTitle($videoId);
                        $replacement = '
                                    <div class="flex flex-row items-center w-full bg-white shadow-md rounded-lg p-4 hover:bg-gray-50 transition-all">
                                        <h3 class="flex-grow text-gray-700 font-semibold">' . $videoTitle . '</h3>
                                        <a href="http://127.0.0.1:8000/view-single-video/' . $videoId . '" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mr-2 flex items-center" onclick="changeStatusCircle(this)">
                                            <i class="fas fa-play mr-2"></i> Play
                                        </a>
                                        <div id="status-circle-' . $videoId . '" class="w-5 h-5 bg-gray-400 rounded-full flex justify-center items-center">
                                            <i id="check-' . $videoId . '" class="fas fa-check text-white"></i>
                                        </div>
                                    </div>
                                    <script>
                                        function changeStatusCircle(el) {
                                            // Finding the sibling element with the id that starts with "status-circle-"
                                            var statusCircle = el.parentElement.querySelector("[id^=\'status-circle-\']");
                                            var checkmark = el.parentElement.querySelector("[id^=\'check-\']");
                                            if (statusCircle && checkmark) {
                                                statusCircle.style.backgroundColor = "green"; // Changing the color to green
                                                checkmark.hidden = false; // Revealing the checkmark
                                            }
                                        }
                                    </script>
                                    ';
                        return $replacement;
                    },
                    $content
                );

                ?>

            <p class="mt-0 text-sm sm:text-base break-all overflow-hidden content-paragraph">
                {!! $content !!}
            </p>
            <div
                class="flex flex-col space-y-2 sm:space-y-0 sm:flex-row justify-between"
            >
                <div
                    class="flex flex-row items-center bg-white shadow-md rounded-lg p-2 hover:bg-gray-50 transition-all text-sm sm:text-base">
                    <span class="text-gray-700 font-semibold">Solve UWorld Questions</span>
                    <button
                        onclick="createTestOnUsmlepreps({ ids: {{ json_encode( $test->questions_ids) }} })"
                        class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-1 px-2 border-b-2 border-green-700 hover:border-green-500 rounded text-xs sm:text-sm ml-2"
                    >Solve
                    </button>
                    <div id="solve-status-circle-{{$test->id}}"
                         class="w-4 h-4 bg-gray-400 rounded-full flex justify-center items-center ml-2">
                        <i class="fas fa-check text-white"></i>
                    </div>
                </div>
                {{--                <a--}}
                {{--                    onclick="createTestOnUsmlepreps({ ids: {{ json_encode( $test->questions_ids) }} })"--}}
                {{--                    class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded text-sm sm:text-base"--}}
                {{--                >Create test on Usmlepreps</a--}}
                {{--                >--}}
                <a
                    href="{{ route('download.material', ['test' => $test]) }}"
                    class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded text-sm sm:text-base flex items-center justify-center"
                >
                    <i class="fas fa-download mr-2"></i> View Materials
                </a>
            </div>
        </div>
    </div>
    <input type="hidden" name="request_api_url" id="request_api_url" value="{{env('API_TO_SOLVE_TASK')}}">
    <input type="hidden" name="solved_api_url" id="solved_api_url" value="{{env('API_TO_CHECK_IF_SOLVED')}}">
    <input type="hidden" name="email" id="email" value="{{auth()->check() ? auth()->user()->email : null}}">
    <input type="hidden" name="task_id" id="task_id" value="{{$test->id}}">
@endsection

@push('script')
    <!-- JavaScript code to handle expandable sections -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const email = document.getElementById('email').value;
            const taskId = document.getElementById('task_id').value;
            if (email)
                checkIfSolved(email, taskId);
        });

        function checkIfSolved(email, taskId) {
            const url = document.getElementById('solved_api_url').value;
            // const url = '/api/check-solved';
            console.log(url);
            const data = {
                email: email,
                taskId: taskId
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
                    // Find the circle element (update this selector if needed)
                    const circleElement = document.getElementById('solve-status-circle-' + taskId);
                    if (data.success) {
                        circleElement.style.backgroundColor = 'green';
                    } else {
                        // Handle failure case if needed
                    }

                })
                .catch(error => {
                    // Handle error
                    console.error('An error occurred while checking if solved.', error);
                });
        }

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
