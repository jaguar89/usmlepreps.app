@extends('app')
    @push('css')

        <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet"/>

    @endpush

@section('content')

    <div class="flex flex-col md:flex-row">
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
                    <source src="https://youtu.be/U5rLz5AZBIA" type="video/mp4"/>

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
                <p>List of all videos:</p>
                <!-- List of Videos -->
                <ul>
                    @foreach($videos as $video)
                        <li class="video-item cursor-pointer mb-1 flex justify-between items-center hover:bg-gray-400 transition-all duration-200 ease-in-out border border-gray-300 rounded shadow-sm"
                            data-video-src="{{ asset('storage/' . $video->path) }}">
                            <!-- Thumbnail and Title -->
                            <div class="flex items-center p-2 w-3/4">
                                @if($video->thumbnail)
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Video Thumbnail"
                                         class="w-16 h-9 inline-block mr-2"/>
                                @else
                                    <i class="fas fa-film fa-2x mr-2 text-gray-600"></i>
                                    <!-- Default Font Awesome icon -->
                                @endif
                                <span>{{$video->title}}</span>
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
@endsection

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
    </script>
@endpush
