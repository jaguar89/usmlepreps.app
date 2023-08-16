<x-app-layout>
    @push('script')
        <script src="https://cdn.tiny.cloud/1/f15fyjs0mqpwpvbpsxvo34k1pw1c2u78dl59s6hlthrxli1e/tinymce/6/tinymce.min.js"
                referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#test-content',
            });
        </script>
    @endpush
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tests') }}
            </h2>
            <nav class="flex space-x-4">
                <a href="{{ route('tests') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    All Tests
                </a>
                <a href="{{ route('tests.create') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create Test
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

            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                <tr>
                    <th class="w-24 py-2 px-4 border-b">Test ID</th>
                    <th class="py-2 px-4 border-b">System Name</th>
                    <th class="w-24 py-2 px-4 border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tests as $test)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $test->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $test->system->name }}</td>
                        <td class="py-2 px-4 flex justify-around items-center space-x-4 {{($loop->index == 0) ? '' : 'border-t'}}">
                            <a href="{{ route('tests.edit', $test) }}"
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            <form action="{{  route('tests.destroy', $test) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
</x-app-layout>
