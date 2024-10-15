<div>
        
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $room->name }}
            </h2>
    
            
        </x-slot>
        
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div id="messageContainer" class="p-6 text-gray-900 dark:text-gray-100" x-init="Echo.private('chat.room.2').listen('Example',event => {
                                    newMessages.push(event);
                                    console.log(event);
                                    elem.scrollTop = elem.scrollHeight;

                                });" x-data="{
                                    elem:document.getElementById('chatContainer'),
                                    newMessages:[],
                                }">
                                <div class="chat" id="chatContainer" style="max-height: 300px; overflow-y: auto; background-color: #1f2937; padding: 10px; border-radius: 10px;">
                                    @foreach ($messages as $index => $m)
                                        <div>{{ $m['user']['name'] }} : {{ $m['message'] }}</div>
                                        
                                    @endforeach
                                    <template x-for="message in newMessages">
                                        <div><span x-text="message.user.name"></span> : <span x-text="message.message"></span></div>

                                    </template>

                                </div>
                            </div>
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                                <div class="p-4 text-gray-900 dark:text-gray-100">
                                    <form wire:submit.prevent="sendMessage" class="flex items-center space-x-4">
                                        <input wire:model="message" type="text" class="flex-grow p-3 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Type your message..."/>
                                        <button type="submit" wire:loading.remove class="p-3 bg-blue-500 dark:bg-blue-600 text-white rounded-lg hover:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition duration-200">
                                            Send
                                        </button>
                                        <button wire:loading type="submit" wire:target="sendMessage" >
                                            <span class="loader" ></span>

                                        </button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin: 30px">
                    
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 text-gray-900 dark:text-gray-100">
                        
                        <div wire:model="userInRoom">
                            {{-- <div wire:loading wire:target="userInRoom">Loading . . .</div> --}}
                            @foreach ($userInRoom as $index => $user)
                                <div wire:model="userInRoom.{{ $index }}" style="color: yellow">{{ $user }}</div>
                                
                            @endforeach
                            {{-- <template x-for="user in usersHere">
                                <div x-text="user.name" style="color: yellow"></div>
                            </template> --}}
                        </div>
    
                        {{-- {{ __("You're logged in!") }} --}}
    
                    </div>
                </div>
            </div>
        </div>    
        @push('scripts')
            elem.scrollTop = elem.scrollHeight;
            
        @endpush

</div>


