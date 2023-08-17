<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Systems') }}
            </h2>
            <nav class="flex space-x-4">
                <a href="{{ route('systems') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    All Systems
                </a>
                <a href="{{ route('systems.create') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create System
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="container mx-auto p-10">
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
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
            <tr>
                {{--                <th class="py-2 px-4 border">ID</th>--}}
                <th class="w-24 py-2 px-4 border">Image</th>
                <th class="py-2 px-4 border">Name</th>
                <th class="w-24 py-2 px-4 border">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($systems as $system)
                <tr>
                    {{--                    <td class="py-2 px-4 border">{{ $system->id }}</td>--}}
                    <td class="py-2 px-4 border">
                        @if($system->image_path)
                            <img src="{{ asset('storage/' . $system->image_path) }}" alt="{{ $system->name }}"
                                 class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="fas fa-graduation-cap text-gray-600 text-4xl"></span> <!-- Default book icon -->
                        @endif
                    </td>
                    <td class="py-2 px-4 border">{{ $system->name }}</td>
                    <td class="py-2 px-4 flex justify-around items-center space-x-4 {{($loop->index == 0) ? '' : 'border-t'}}">
                        <a href="{{ route('systems.edit', $system) }}"
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <form action="{{ route('systems.destroy', $system) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $systems->links() }} <!-- Pagination links -->
        </div>
    </div>
</x-app-layout>
