<div :class="{ 'hidden': screenWidth < 768 && !isSidebarOpen, 'absolute inset-0 z-10': screenWidth < 768 && isSidebarOpen }"
    class="md:w-96 bg-gray-100 dark:bg-gray-900 p-4 md:relative">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">All Chats</h2>
        <button class="text-gray-400 md:hidden" x-on:click="isSidebarOpen = false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <input type="text" class="w-full bg-white dark:bg-gray-800 text-gray-200 px-4 py-2 rounded" placeholder="Search">
    </div>

    <!-- Scrollable Chat List Container -->
    @persist('scrollbar')
        <div wire:scroll class="overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900 h-[calc(100vh-150px)]">
            <ul class="space-y-2">
                @foreach ($this->conversations as $conversation)
                    <x-chat.conversation-button
                        :active="request()->routeIs($conversation->is_user ? 'chat.user' : 'chat.group', ['conversation' => $conversation->id])"
                        :conversation="$conversation"
                    />
                @endforeach
            </ul>
        </div>
    @endpersist
</div>
