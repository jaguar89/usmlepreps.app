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
    </style>
@endpush

@section('content')

    <div class="container mx-auto p-10 content">
        <!-- Loop through each expandable section -->
        @foreach($tests as $test)
            <div class="expandable-section p-4 bg-white shadow rounded mb-4">
                <div
                    class="flex justify-between cursor-pointer"
                    onclick="toggleSection('section{{ $loop->index }}', 'icon{{ $loop->index }}')"
                >
                    <h1
                        class="text-xl font-bold text-gray-600 flex flex-row items-center"
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
                                d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"
                            />
                        </svg
                        >
                        &nbsp {{$test->system->name}}
                    </h1>
                    <span id="icon{{ $loop->index }}" class="arrow-down"></span>
                </div>
                <div id="section{{ $loop->index }}" class="hidden flex flex-col space-y-4">
                    <p class="mt-8">Content for {{$test->system->name}}</p>
                    <p class="mt-0">
                        {{$test->content}}
                    </p>
                    <div
                        class="flex flex-col space-y-1 sm:space-y-0 sm:flex-row justify-between"
                    >
                        <a
                            href="#"
                            class="bg-green-500 w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"
                        >Create test on Usmlepreps</a
                        >
                        <a
                            href="#"
                            class="bg-green-500 w-auto text-center hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded"
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
    </script>

@endpush

