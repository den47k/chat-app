<div class="flex justify-end">
    <div class="flex items-start space-x-3 max-w-[66%]"> <!-- Reduced max-width for proper wrapping -->
        <div>
            <div class="bg-gray-500 p-3 rounded-lg text-white break-words max-w-full"> <!-- Added max-w-full for the message container -->
                <p>{{ $message->message }}</p>
            </div>
            <span class="text-gray-400 text-sm">{{ $message->created_at->format('H:i') }}</span>
        </div>
        <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full object-cover"
                src="{{ $message->sender->profile_photo_url }}" alt="{{ $message->sender->name }}" />
        </div>
    </div>
</div>
