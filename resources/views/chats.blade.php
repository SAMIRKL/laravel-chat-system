<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- {{ $room->name }} --}}
            Rooms
        </h2>

        
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>

                        @foreach ($rooms as $roomId => $room )
                            <div class="mx-5">
                                <a href="{{ route('dashboard.room', $room->id) }}">
                                    {{ $room->name }}
                                </a>
                               
                            </div>
                        @endforeach
                        {{-- <h5 class="font-semibold text-lg">Users Here : </h5> --}}
                        {{-- <template x-for="user in usersHere"> --}}
                            {{-- <div x-text="user.name"></div> --}}
                        {{-- </template> --}}
                    </div>

                    {{-- {{ __("You're logged in!") }} --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
