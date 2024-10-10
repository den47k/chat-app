<div class="flex items-start space-x-3 w-[66%]">
    <div class="flex-shrink-0">
        <img class="h-10 w-10 rounded-full object-cover"
            src="{{ $message->sender->profile_photo_url }}" alt="{{ $message->sender->name }}" />
    </div>
    <div>
        <div class="bg-gray-700 p-3 rounded-lg">
            <p class="text-white">{{ $message->message }}</p>
        </div>
        <span class="text-gray-400 text-sm">{{ $message->created_at->format('H:i') }}</span>
    </div>
</div>
