{{-- <div class="h-screen flex flex-col bg-gray-100 dark:bg-gray-900"
x-data="{height: 0, conversationElement: document.getElementById('chat-messages')}"
x-init="
    height = conversationElement.scrollHeight;
    $nextTick(()=>conversationElement.scrollTop = height);
"
@scroll-bottom.window="
    $nextTick(()=>conversationElement.scrollTop = height);
"> --}}

<div class="h-screen flex flex-col bg-gray-100 dark:bg-gray-900"
     x-data="{
         height: 0,
         scrollToBottom() {
             this.$nextTick(() => {
                 this.$refs.conversationElement.scrollTop = this.$refs.conversationElement.scrollHeight;
             });
         }
     }"
     x-init="scrollToBottom()"
     @scroll-bottom.window="scrollToBottom()"
>

    <!-- Chat Header and Sidebar Toggle -->
    <div class="flex items-center justify-between border-b border-gray-700 pb-3 mb-4">
        <!-- Sidebar Toggle Button -->
        <button class="text-gray-400 mr-4" x-show="screenWidth < 768" x-on:click="isSidebarOpen = !isSidebarOpen">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18m-6 6 6-6-6-6" />
            </svg>
        </button>

        <!-- Chat Header -->
        <div class="flex items-center space-x-3 flex-grow">
            <div class="flex-shrink-0">
                <span class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-xl">T</span>
            </div>
            <div>
                <h3 class="text-white text-lg">test_channel</h3>
                <p class="text-gray-400 text-sm">1 subscriber</p>
            </div>
        </div>

        <div class="hidden sm:flex sm:items-center md:ms-6">
            <!-- Settings Dropdown -->
            <div class="ms-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link wire:navigate href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Chat Messages -->
    {{-- <div id="chat-messages"
        class="flex-1 overflow-y-auto space-y-4 p-4 h-[calc(100vh-200px)] scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900"> --}}
        <div id="chat-messages" x-ref="conversationElement"
        class="flex-1 overflow-y-auto space-y-4 p-4 h-[calc(100vh-200px)] scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
        @isset($messages)
            @foreach ($messages as $message)
                @if ($message->sender->id === Auth::id())
                    <x-chat.auth-message-card :message="$message"/>
                    {{-- @include('components.auth-message-card', ['message' => $message]) --}}
                @else
                    <x-chat.other-message-card :message="$message"/>
                    {{-- @include('components.other-message-card', ['message' => $message]) --}}
                @endif
            @endforeach
        @endisset
    </div>



    <!-- Message Input -->
    <div class="p-4 mt-2 mb-8 rounded-lg">
        <div class="flex items-center space-x-3">
            <!-- Bind input to Livewire message property -->
            <input type="text" wire:model="messageInput" wire:keydown.enter="store"
                class="flex-1 bg-white dark:bg-gray-800 text-gray-200 px-4 py-2 rounded"
                placeholder="Type a message..." />

            <button wire:click="store" class="bg-purple-500 p-3 rounded-full text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18m-6 6 6-6-6-6" />
                </svg>
            </button>
        </div>
    </div>
</div>
