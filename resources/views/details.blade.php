@extends('app')

@push('css')
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Allowing the main content to grow to fill the available space */
        .content {
            flex-grow: 1;
        }

        /* Adding custom arrow icons using CSS */
        .arrow-down {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid currentColor;
        }

        .arrow-up {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid currentColor;
        }

        .content-paragraph {
            max-width: 100%; /* Full width on small screens */
            overflow-wrap: break-word; /* Breaks long words */
            word-break: break-all; /* Breaks the words at any character */
        }

        @media (min-width: 640px) {
            /* For larger screens */
            .content-paragraph {
                max-width: 90%; /* You can adjust this value */
            }
        }

        @media (min-width: 1024px) {
            /* For even larger screens */
            .content-paragraph {
                /*max-width: 80%; !* You can adjust this value *!*/
            }
        }

        p a {
            color: blue !important; /* Sets the color of the link text to blue */
            text-decoration: underline !important; /* Underlines the link text */
            display: inline-block; /* Allows overflow to be hidden */
            max-width: 100%; /* Ensures link doesn't exceed container's width */
            overflow: hidden; /* Hides overflow */
            text-overflow: ellipsis; /* Adds ellipsis if text overflows */
            white-space: nowrap; /* Prevents the text from wrapping onto the next line */
        }

        .tooltip-link {
            position: relative;
        }

        .tooltip-link:hover:after {
            content: attr(data-tooltip);
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%); /* Centering the tooltip */
            padding: 0.5rem; /* Increasing padding */
            border-radius: 0.5rem; /* Larger border radius */
            background-color: #333; /* Dark background */
            color: #fff; /* White text */
            font-size: 0.875rem; /* Larger font size */
            white-space: nowrap;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Adding a shadow for a bit of depth */
        }

    </style>
@endpush

@section('content')

    <div class="container mx-auto p-10 content">
        <!-- Flash messages section -->
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded relative alert"
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
        <!-- Loop through each expandable section -->
        @foreach($tests as $test)
            <div class="expandable-section p-4 bg-white shadow rounded mb-4" id="title-{{$test->title}}">
                <div
                    class="flex flex-col sm:flex-row  justify-between cursor-pointer mt-3"
                    onclick="toggleSection('section{{ $loop->index }}', 'icon{{ $loop->index }}' ,'{{$test->id}}')"
                >
                    <h1
                        class="text-xl font-bold text-gray-600 flex flex-row items-center"
                    >
                        <!-- Your existing SVG and other content -->
                        &nbsp {{$test->title}}
                    </h1>

                    <span id="icon{{ $loop->index }}" class="hidden sm:block arrow-down"></span>
                </div>

                <div id="section{{ $loop->index }}" class="hidden flex flex-col space-y-4">
                    <div class="flex flex-col  justify-between items-end space-y-2">
                        <div class="w-full p-3 bg-gray-200 rounded">
                            {{--                            <p class="text-xs sm:text-sm">--}}
                            {{--                                Task Title: {{$test->title}}--}}
                            {{--                            </p>--}}
                            <div class="flex items-center">
                                <input type="text"
                                       value="{{route('view.test.blank', 'id='.$test->id.'&title='.$test->title)}}"
                                       disabled
                                       class="flex-grow border rounded p-1 text-xs text-gray-600 focus:outline-none">
                                <button onclick="copyLink({{$test->id}}, '{{'title-' . $test->title}}')"
                                        class="ml-2 text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded focus:outline-none text-xs">
                                    Copy URL
                                </button>
                            </div>
                        </div>


                        {{--                        @auth()--}}
                        {{--                            @if(!auth()->user()->isAdmin() && auth()->user()->tests()->where('test_id',$test->id)->wherePivot('solved', true)->exists())--}}
                        <div class="hidden" id="completeButtonContainer{{$test->id}}">
                            <button
                                onclick="completeTest({{$test->system_id}},{{$test->id}},{{auth()->user()->id}})"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold p-2 rounded-full ml-auto flex items-center"
                            >
                                <i class="fas fa-check mr-2"></i>
                                Mark as complete
                            </button>
                        </div>

                        {{--                            @elseif(!auth()->user()->isAdmin() && auth()->user()->tests()->where('test_id',$test->id)->wherePivot('solved', true)->exists() && !auth()->user()->tests()->where('test_id',$test->id)->wherePivot('completed', true)->exists())--}}
                        <div class="hidden flex flex-row items-center space-x-8"
                             id="incompleteButtonContainer{{$test->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" style="stroke-width:4;"
                                      d="M5 13l4 4L19 7"/>
                            </svg>


                            <button
                                onclick="incompleteTest({{$test->system_id}},{{$test->id}},{{auth()->user()->id}})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full ml-auto flex items-center"
                            >
                                <i class="fas fa-times mr-2"></i>
                                Incomplete Task
                            </button>

                        </div>
                        {{--                            @endif--}}
                        {{--                        @endauth--}}
                    </div>
                        <?php
                        if (!function_exists('isVideoWatched')) {
                            function isVideoWatched($videoId) {
                                $user = auth()->user();
                                if (!$user) {
                                    return false; // Not authenticated
                                }

                                return $user->videos()
                                    ->where('video_id', $videoId)
                                    ->wherePivot('watched', true)
                                    ->exists();
                            }
                        }
                        if (!function_exists('getVideoTitle')) {
                            function getVideoTitle($videoId) {
                                $video = \App\Models\Video::find($videoId);
                                return $video ? $video->title : 'Video not found';
                            }
                        }
                        $content = $test->content;

                        // Match the entire pattern including the <strong> and <span> tags, and replace with the desired div
                        $content = preg_replace_callback(
                            '/<span style="font-size: 18pt;"><strong><span style="color: rgb\(132, 63, 161\);"><a [^>]*href=".*?\/view-single-video\/(\d+).*?"[^>]*>.*?<\/a><\/span><\/strong><\/span>/',
                            function ($matches) {
                                // Get the videoId from the URL
                                $videoId = $matches[1];

                                $videoTitle = getVideoTitle($videoId);
                                $replacement = '
                <div class="flex flex-row items-center w-full bg-white shadow-md rounded-lg p-4 hover:bg-gray-50 transition-all">
                    <h3 class="flex-grow text-gray-700 font-semibold">' . $videoTitle . '</h3>
                    <a href="' . env(
                                        "APP_URL"
                                    ) . '/view-single-video/' . $videoId . '" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mr-2 flex items-center" onclick="changeStatusCircle(this,' . $videoId . ')">
                        <i class="fas fa-play mr-2"></i> Play
                    </a>
                    <div id="status-circle-' . $videoId . '" class="w-5 h-5 '.(isVideoWatched($videoId) ? 'bg-green-400' : 'bg-gray-400').' rounded-full flex justify-center items-center p-3">
                        <i id="check-' . $videoId . '" class="fas fa-check text-white"></i>
                    </div>
                </div>
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
                        class="flex flex-col  space-y-2 space-x-0 sm:space-x-2 justify-between items-center">
                        {{--                        large screen view--}}
                        <div
                            class="hidden sm:flex w-full flex-row justify-between items-center bg-gray-200 shadow-sm p-6 transition-all text-sm sm:text-base">
                            <span class="w-1/2 text-gray-700 font-semibold">Solve UWorld Questions</span>
                            <div class="flex items-center">
                                <button
                                    onclick="createTestOnUsmlepreps({ ids: {{ json_encode($test->questions_ids) }} })"
                                    class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-3 px-4 border-b-4 border-green-700 hover:border-green-500 rounded text-xs sm:text-sm flex items-center justify-center space-x-2"
                                >
                                    <i class="fas fa-lightbulb mr-2"></i> <!-- The lightbulb icon -->
                                    Solve
                                </button>
                                <div id="solve-status-circle-{{$test->id}}"
                                     class="w-1/2 w-4 h-4 bg-gray-400 rounded-full flex justify-center items-center p-3 ml-2">
                                    <!-- Adjusted padding -->
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                        </div>
                        {{--                        mobile view--}}
                        <div
                            class="w-full flex flex-col space-y-4 sm:hidden items-center bg-gray-200 shadow-sm p-3 transition-all text-sm sm:text-base">
                            <div class="flex w-full items-center justify-between p-2">
                                <span class="text-gray-700 font-semibold">Solve UWorld Questions</span>
                                <div id="solve-status-circle-mobile-{{$test->id}}"
                                     class="w-4 h-4 bg-gray-400 rounded-full flex justify-center items-center p-3 ml-2">
                                    <!-- Adjusted padding -->
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                            <button
                                onclick="createTestOnUsmlepreps({ ids: {{ json_encode($test->questions_ids) }} })"
                                class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-3 border-b-4 border-green-700 hover:border-green-500 rounded text-xs sm:text-sm flex items-center justify-center space-x-2"
                            >
                                <i class="fas fa-lightbulb mr-2"></i> <!-- The lightbulb icon -->
                                Solve
                            </button>
                        </div>
                        {{--                        <a--}}
                        {{--                            onclick="createTestOnUsmlepreps({ ids: {{ json_encode( $test->questions_ids) }} })"--}}
                        {{--                            class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded text-sm sm:text-base"--}}
                        {{--                        >Create test on Usmlepreps</a--}}
                        {{--                        >--}}
                        <a
                            href="{{ route('download.material', ['test' => $test]) }}"
                            class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-1 px-2 border-b-2 border-green-700 hover:border-green-500 rounded flex items-center justify-center"
                        >
                            <i class="fas fa-download mr-2"></i> View Materials
                        </a>
                    </div>

                </div>

            </div>
        @endforeach

        <input type="hidden" name="request_api_url" id="request_api_url" value="{{env('API_TO_SOLVE_TASK')}}">
        <input type="hidden" name="solved_api_url" id="solved_api_url" value="{{env('API_TO_CHECK_IF_SOLVED')}}">
        <input type="hidden" name="email" id="email" value="{{auth()->check() ? auth()->user()->email : null}}">

    </div>

@endsection

@push('script')
    <!-- JavaScript code to handle expandable sections -->
    <script>
        /**
         * Toggle the content of the section and change the icon.
         * Close other sections if one is opened.
         * @param {string} sectionId - The ID of the section to toggle.
         * @param {string} iconId - The ID of the icon to toggle.
         */


        function toggleSection(sectionId, iconId, taskId) {
            // Reference to all expandable sections
            const allSections = document.querySelectorAll(".expandable-section");

            // Iterate through each section, close it if it's not the clicked section
            allSections.forEach((section) => {
                const content = section.querySelector('div[id^="section"]');
                const icon = section.querySelector(".arrow-up, .arrow-down");

                // Close the section and change the icon if it's not the clicked section
                if (content.id !== sectionId) {
                    content.classList.add("hidden");
                    icon.classList.remove("arrow-up");
                    icon.classList.add("arrow-down");
                }
            });

            // Toggle clicked section
            const content = document.getElementById(sectionId);
            const icon = document.getElementById(iconId);

            content.classList.toggle("hidden");

            // Change icon based on the content visibility
            if (content.classList.contains("hidden")) {
                icon.classList.remove("arrow-up");
                icon.classList.add("arrow-down");
            } else {
                icon.classList.remove("arrow-down");
                icon.classList.add("arrow-up");
            }
            const email = document.getElementById('email').value;
            if (email)
                checkIfSolved(email, taskId);
        }

        // this function changes circle color for watched videos
        function changeStatusCircle(el, videoId) {
            const url = '/mark-video-as-watched/' + videoId;
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Include CSRF token if you're using Laravel
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            };
            fetch(url , options)
                .then(response => response.json())
                .then(data => {
                    const statusCircle = document.getElementById('status-circle-' + videoId);
                    if (!statusCircle.classList.contains('bg-green-400')) {
                        statusCircle.classList.remove('bg-gray-400');
                        statusCircle.classList.add('bg-green-400');
                    }

                })
                .catch(error => {
                    // Handle error
                    console.error('An error occurred while marking the video as watched', error);
                });
        }

        function checkIfSolved(email, taskId) {
            // const url = document.getElementById('solved_api_url').value;
            const url = '/api/check-solved';
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
                    const circleElementMobile = document.getElementById('solve-status-circle-mobile-' + taskId);
                    if (data.success) {
                        circleElement.style.backgroundColor = 'green';
                        circleElementMobile.style.backgroundColor = 'green';
                        if (data.completed) {
                            document.getElementById('incompleteButtonContainer' + taskId).classList.toggle('hidden');
                        } else {
                            document.getElementById('completeButtonContainer' + taskId).classList.toggle('hidden');
                        }
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
                    location.href = '/view-tasks/' + data.systemId;
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
                    location.href = '/view-tasks/' + data.systemId;
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

        function copyLink(testId, title) {
            var encodedTitle = encodeURIComponent('id=' + testId + '&title=' + title);
            var baseUrl = window.location.protocol + '//' + window.location.host;
            var link = baseUrl + '/view-single-task/' + encodedTitle;

            // Now you can copy 'link' to the clipboard
            // Here's how you might do that:
            navigator.clipboard.writeText(link).then(function () {
                console.log('Link copied to clipboard:', link);
            }).catch(function (err) {
                console.error('Failed to copy link:', err);
            });
            alert('Link copied to clipboard!'); // Optionally notify the user
        }

    </script>

@endpush

