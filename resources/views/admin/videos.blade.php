<x-app-layout>
    @push('css')

        <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet"/>
        <style>
            /* Additional styles for buttons */
            .action-button {
                cursor: pointer;
                padding: 8px 12px;
                margin: 0 4px;
                background-color: #f0f0f0;
                border-radius: 4px;
                border: 1px solid #ccc;
                transition: background-color 0.3s;
            }
            .action-button:hover {
                background-color: #e0e0e0;
            }

            .action-button {
                color: #7e7e7e; /* Text color */
                transition: color 0.3s ease;
            }

            .action-button:hover {
                color: #000; /* Text color on hover */
            }
            /* Dropdown menu styles */
            .hidden {
                display: none;
            }
            .action-menu {
                min-width: 150px;
                border: 1px solid #ccc;
                background-color: #fff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush
    @push('script')
        <script src="https://vjs.zencdn.net/7.11.4/video.js"></script>
        <script>
            // Declare a JavaScript array to store the video URLs
            const videosArray = @json($videos->map(function ($video) {
        // Use Laravel's asset function to create the full URL
        return asset('storage/' . $video->path);
    }));

    document.addEventListener('DOMContentLoaded', () => {
        // Initialize the player
        const player = videojs('my-video');

        // If there are videos, set the first one as the source and play
        if (videosArray.length > 0) {
            player.src({
                type: 'video/mp4',
                src: videosArray[0] // The first video URL
            });
            player.play();
        }

        // Add click event listener for each video item
        document.querySelectorAll('.video-item').forEach((item, index) => {
            item.addEventListener('click', function () {
                // Get the video URL from the videosArray
                const videoSrc = videosArray[index];

                // Update the player's source
                player.src({
                    type: 'video/mp4',
                    src: videoSrc
                });

                // Optionally, you can play the video automatically
                player.play();
            });
        });
            })
            ;

            function copyLink(link) {
                var dummy = document.createElement('input');
                document.body.appendChild(dummy);
                dummy.value = link;
                dummy.select();
                document.execCommand('copy');
                document.body.removeChild(dummy);
                alert('Link copied to clipboard!'); // Optionally notify the user
            }

            // Function to toggle the dropdown
            function toggleDropdown(event, videoId) {
                // Prevent this click from triggering the document's click event
                event.stopPropagation();

                let dropdown = document.getElementById(`dropdown-${videoId}`);
                dropdown.classList.toggle('hidden');
            }

            // Event listener for clicking outside the dropdown
            document.addEventListener('click', function (event) {
                let dropdowns = document.querySelectorAll('.action-menu'); // Select all dropdowns
                dropdowns.forEach(function (dropdown) {
                    // If the click was outside the dropdown, and the dropdown is not hidden
                    if (!dropdown.contains(event.target) && !dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden'); // Hide the dropdown
                    }
                });
            });
        </script>

        {{--        <script>--}}

        {{--            document.addEventListener('DOMContentLoaded', () => {--}}
        {{--                // Existing code to initialize the player--}}
        {{--                const player = videojs('my-video');--}}

        {{--                // Add click event listener for each video item--}}
        {{--                document.querySelectorAll('.video-item').forEach(item => {--}}
        {{--                    item.addEventListener('click', function () {--}}
        {{--                        // Get the video URL from the clicked item--}}
        {{--                        const videoSrc = this.getAttribute('data-video-src');--}}

        {{--                        // Update the player's source--}}
        {{--                        player.src({--}}
        {{--                            type: 'video/mp4',--}}
        {{--                            src: videoSrc--}}
        {{--                        });--}}

        {{--                        // Optionally, you can play the video automatically--}}
        {{--                        player.play();--}}
        {{--                    });--}}
        {{--                });--}}
        {{--            })--}}
        {{--            ;--}}

        {{--        </script>--}}
    @endpush
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Videos') }}
            </h2>
        </div>
    </x-slot>

    <div x-data="{ showModal: false }" class="flex flex-col md:flex-row">
        @if(session('success'))
            <div
                class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end"
                id="success-message" onclick="document.getElementById('success-message').style.display='none'">
                <div
                    class="max-w-sm w-full bg-green-100 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <!-- Check Icon -->
                                <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-green-800">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div id="error-message"
                 class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
                <div
                    class="max-w-sm w-full bg-red-100 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-red-800">
                                    There were some errors with your submission:
                                </p>
                                <ul class="mt-1 text-sm text-red-600 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <!-- Close Icon -->
                                <button onclick="document.getElementById('error-message').style.display='none'"
                                        class="bg-red-100 rounded-md inline-flex text-red-400 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414L11.414 13l2.293 2.293a1 1 0 01-1.414 1.414L10 14.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 13 6.293 10.707a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <x-modal x-show="showModal" x-cloak>
            <!-- Close button -->
            <button @click="showModal = false" type="button"
                    class="bg-red-500 mb-2 hover:bg-red-700 text-white font-bold py-1 px-2 rounded float-right">
                X
            </button>
            <form action="{{route('videos.create')}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 text-sm font-bold">
                        Title (optional):
                    </label>
                    <input type="text" name="title" placeholder="Title for the video"
                           class="border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="videoFile" class="text-gray-700 text-sm font-bold">
                        Choose a video file:
                    </label>
                    <input type="file" id="videoFile" name="videoFile" accept="video/*"
                           class="border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="thumbnail" class="text-gray-700 text-sm font-bold">
                        Thumbnail (optional):
                    </label>
                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                           class="border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                </div>
                <div class="text-left">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Upload
                    </button>
                </div>
            </form>
        </x-modal>


        <div class="flex flex-col lg:flex-row space-x-0 container">
            <!-- Video Player Container -->
            <div class="w-full lg:w-2/3 p-4 flex justify-center items-center">
                <video
                    id="my-video"
                    class="video-js vjs-default-skin"
                    controls
                    preload="auto"
                    width="640"
                    height="360"
                    data-setup='{}'
                >
                    <!-- Source for the video file -->
                    <source src="#" type="video/mp4"/>

                    <!-- Fallback message for browsers that do not support HTML5 video -->
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that <a href="https://videojs.com/html5-video-support/" target="_blank">supports
                            HTML5 video</a>
                    </p>
                </video>
            </div>

            <!-- Playlist Container -->
            <div class="w-full lg:w-1/3 p-4">
                <!-- Add Video Button -->
                <div class="mb-4 text-right">
                    <button @click="showModal = true"
                            class="action-button">
                        Add Video
                    </button>
                </div>
                <!-- List of Videos -->
                <ul>
                    @foreach($videos as $video)
                        <li class="cursor-pointer mb-4 flex justify-between items-center border border-gray-300 rounded shadow-sm">
                            <!-- Thumbnail and Title -->
                            <div class="video-item flex items-center p-2">
                                @if($video->thumbnail)
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Video Thumbnail"
                                         class="w-16 h-9 inline-block mr-2"/>
                                @else
                                    <i class="fas fa-film fa-2x mr-2 text-gray-600"></i>
                                    <!-- Default Font Awesome icon -->
                                @endif
                                <span>{{$video->title}}</span>
                            </div>

                            <!-- Action Icon and Dropdown -->
                            <div class="relative p-2 ">
                                <button onclick="toggleDropdown(event, {{$video->id}})" id="action-icon-{{ $video->id }}" class="action-button text-gray-600 hover:text-gray-800">
                                    <i class="fas fa-ellipsis-v"></i> <!-- Font Awesome ellipsis icon -->
                                </button>
                                <div class="absolute right-0 hidden z-10 action-menu" id="dropdown-{{ $video->id }}">
                                    <!-- Generate Source Link Button -->
                                    <button onclick="copyLink('{{ asset('storage/' . $video->path) }}')"
                                            class="text-center bg-blue-400 hover:bg-blue-600 text-white w-full py-2 rounded-t text-sm">
                                        Copy Source Link
                                    </button>
                                    <!-- Generate Video Link Button -->
                                    <button onclick="copyLink('{{route('view.single.video' , $video->id)}}')"
                                            class="text-center bg-green-400 hover:bg-green-600 text-white w-full py-2 text-sm">
                                        Copy Video Link
                                    </button>
                                    <!-- Delete Button -->
                                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-center text-white bg-red-400 hover:bg-red-600 text-sm w-full py-2 rounded-b">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </li>




                    @endforeach
                </ul>


                <!-- Render pagination links -->
                <div class="mt-4">
                    {{ $videos->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
