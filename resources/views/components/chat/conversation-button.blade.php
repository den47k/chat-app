@props(['active', 'conversation'])

@php
    use App\Models\User;

    $classes = ($active ?? false)
                ? "w-full h-20 bg-gray-700 p-3 rounded flex items-center space-x-3"
                : "w-full h-20 bg-gray-600 p-3 rounded flex items-center space-x-3";

    $profilePhotoUrl = $conversation->is_user ? User::findOrFail($conversation->id)->profile_photo_url : '';

@endphp

<button {{-- {{ $attributes->merge(['class' => $classes]) }} --}} class="w-full h-20 bg-white dark:bg-gray-800 p-3 rounded flex items-center space-x-3" wire:navigate
    wire:click="navigateToConversation({{ $conversation->id }}, {{ $conversation->is_user ? 'true' : 'false' }})">
    <li class="w-full h-full flex items-center space-x-3">
        <div class="flex-shrink-0">
            @if ($conversation->is_user)
                <img class="h-10 w-10 rounded-full object-cover" src="{{ $profilePhotoUrl }}" alt="">
            @else
            <img class="h-10 w-10 rounded-full object-cover" alt="group_photo">
            @endif
        </div>
        <div class="flex-1">
            <h3 class="text-white">{{ $conversation->name }}</h3>
            <p class="text-gray-400 text-sm">Last message...</p>
        </div>
        <span class="text-gray-400 text-sm">{{ $conversation->last_message_date }}</span>
    </li>
</button>
