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
                    onclick="toggleSection('section{{ $loop->index }}', 'icon{{ $loop->index }}')"
                >
                    <h1
                        class="text-xl font-bold text-gray-600 flex flex-row items-center"
                    >
                        <!-- Your existing SVG and other content -->
                        &nbsp {{$test->system->name}}
                    </h1>

                    <span id="icon{{ $loop->index }}" class="hidden sm:block arrow-down"></span>
                </div>

                <div id="section{{ $loop->index }}" class="hidden flex flex-col space-y-4">
                    <div class="flex flex-col  justify-between items-end space-y-2">
                        <div class="w-full p-3 bg-gray-200 rounded">
                            <p class="text-xs sm:text-sm">
                                Task Title: {{$test->title}}
                            </p>
                            <div class="flex items-center">
                                <input type="text" value="{{route('view.test.blank', 'id='.$test->id.'&title='.$test->title)}}" disabled class="flex-grow border rounded p-1 text-xs text-gray-600 focus:outline-none">
                                <button onclick="copyLink({{$test->id}}, '{{'title-' . $test->title}}')" class="ml-2 text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded focus:outline-none text-xs">
                                    Copy URL
                                </button>
                            </div>
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
        @endforeach

        <input type="hidden" name="request_api_url" id="request_api_url" value="{{env('REQUEST_USMLEPREPS_API_URL')}}">

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
        function toggleSection(sectionId, iconId) {
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

