<x-app-layout>
    @push('script')
        <script src="https://cdn.tiny.cloud/1/f15fyjs0mqpwpvbpsxvo34k1pw1c2u78dl59s6hlthrxli1e/tinymce/6/tinymce.min.js"
                referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#test-content',
                plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                editimage_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                // toolbar_sticky_offset: isSmallScreen ? 102 : 108,
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_prefix: '{path}{query}-{id}-',
                autosave_restore_when_empty: false,
                autosave_retention: '2m',
                image_advtab: true,
                link_list: [
                    { title: 'My page 1', value: 'https://www.tiny.cloud' },
                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                ],
                image_list: [
                    { title: 'My page 1', value: 'https://www.tiny.cloud' },
                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                ],
                image_class_list: [
                    { title: 'None', value: '' },
                    { title: 'Some class', value: 'class-name' }
                ],
                importcss_append: true,
                file_picker_callback: (callback, value, meta) => {
                    /* Provide file and text for the link dialog */
                    if (meta.filetype === 'file') {
                        callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                    }

                    /* Provide image and alt text for the image dialog */
                    if (meta.filetype === 'image') {
                        callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                    }

                    /* Provide alternative source and posted for the media dialog */
                    if (meta.filetype === 'media') {
                        callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                    }
                },
                templates: [
                    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                ],
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 600,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_class: 'mceNonEditable',
                toolbar_mode: 'sliding',
                contextmenu: 'link image table',
                // skin: useDarkMode ? 'oxide-dark' : 'oxide',
                // content_css: useDarkMode ? 'dark' : 'default',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
            // tinymce.init({
            //     selector: '#test-content',
            //     plugins: 'code link image media lists table hr anchor',
            //     toolbar: 'code | link image media | template hr anchor',
            //     codesample_languages: [
            //         { text: 'HTML/XML', value: 'markup' }
            //     ],
            //     extended_valid_elements: 'style', // Add any other elements you want to keep
            //     valid_elements: '*[*]', // Allow all elements and attributes
            //     valid_children: '+a[div]', // Allow a elements to have div as children
            //     schema: 'html5', // Use HTML5 schema for better handling of tags
            //     entity_encoding: 'raw',
            //     menubar: true,
            //     menu: {
            //         insert: { title: 'Insert', items: 'link image media | template hr anchor' }
            //     }
            // });
        </script>
    @endpush
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tasks') }}
            </h2>
            <nav class="flex space-x-4">
                <a href="{{ route('tests') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    All Tasks
                </a>
                <a href="{{ route('tests.create') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create Task
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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

                <div class="p-6 rounded-lg">
                    <h1 class="text-2xl mb-4  text-center">Update Test</h1>
                    <form action="{{route('tests.update' , $test)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="system">
                                Choose a system:
                            </label>
                            <select name="system" id="system"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($systemObjects as $systemObject)
                                    <option value="{{$systemObject->id}}" {{($systemObject->id == $test->system_id)?'selected':''}}>{{$systemObject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-600">Tiltle:</label>
                            <input type="text" id="title" name="title" value="{{$test->title}}" class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="test-content">
                                Add test content:
                            </label>
                            <textarea name="test_content" id="test-content"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                      rows="5">{{$test->content}}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="material">
                                upload materials (*.zip , *.rar):
                            </label>
                            <input type="file" id="material" name="material" class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="questions_ids">
                                Question IDs (comma separated numbers):
                            </label>
                            <input type="text" id="questions_ids" name="questions_ids" value="{{$test->questions_ids}}" class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
