# Some Code Samples:

### Support Ticket Messages
```php
@foreach ($messages as $message)
    @if ($ticket->user_uuid == $message->user_uuid)
        <div class="flex justify-start">
    @else
        <div class="flex justify-end">
    @endif

    @if (auth()->user()->uuid == $message->user_uuid)
        <div class="bg-blue-100">
    @else
        <div class="bg-gray-100">
    @endif
        <div class="p-3 rounded-lg max-w-xs">
            <p class="font-semibold text-gray-800">{{ $message->user->username }}</p>
            <p class="text-sm">{{ $message->message }}</p>
            <span class="text-xs block mt-1 text-right text-gray-500">
                {{ $message->created_at->format('d.m.Y H:i') }}
            </span>
        </div>
    </div>
    </div>
@endforeach
