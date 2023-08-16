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

    </style>
@endpush

@section('content')

    <div class="container mx-auto p-10 content">
        <!-- Loop through each expandable section -->
        @foreach($tests as $test)
            <div class="expandable-section p-4 bg-white shadow rounded mb-4">

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
                    <div class="flex flex-col sm:flex-row justify-between items-start space-y-2 sm:space-y-0">
                        <p class="mt-8 text-sm sm:text-base">Content for {{$test->system->name}}</p>
                        @if(!auth()->user()->isAdmin() && !auth()->user()->tests()->where('test_id',$test->id)->wherePivot('completed', true)->exists())
                            <button
                                onclick="completeTest({{$test->system_id}},{{$test->id}} , {{auth()->user()->id}})"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded-full text-xs ml-auto"
                            >
                                Complete
                            </button>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" />
                            </svg>

                        @endif
                    </div>
                    <p class="mt-0  text-sm sm:text-base break-all overflow-hidden content-paragraph">
                        {{$test->content}}
                    </p>
                    <div
                        class="flex flex-col space-y-2 sm:space-y-0 sm:flex-row justify-between"
                    >
                        <a
                            href="#"
                            class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded text-sm sm:text-base"
                        >Create test on Usmlepreps</a
                        >
                        <a
                            href="#"
                            class="bg-green-500 w-full sm:w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded text-sm sm:text-base"
                        >
                            View Materials
                        </a>
                    </div>
                </div>

            </div>
        @endforeach
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

        function completeTest(systemId,testId, userId) {
            // URL where you'll send the POST request
            const url = `/complete-test/${testId}`;

            // POST data
            const data = {
                test_id: testId,
                user_id: userId,
                system_id : systemId
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
                    location.href = '/tests/' + data.systemId;
                })
                .catch(error => {
                    // Handle error
                    console.error('An error occurred while marking the test as complete', error);
                });
        }

    </script>

@endpush

