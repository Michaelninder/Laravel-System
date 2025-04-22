# Some Code Samples:

### Lang Switcher based on the lang resource folders
```php

<div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-28 bg-white border rounded shadow-lg z-50">
    @foreach(File::exists(resource_path('lang')) ? File::directories(resource_path('lang')) : [] as $langDir)
        @php $lang = basename($langDir); @endphp
        @if($lang !== app()->getLocale())
            <a href="{{ url('/set-locale/' . $lang) }}" class="flex items-center px-3 py-2 hover:bg-gray-100 text-sm">
                <img src="{{ asset('img/SetLocale/' . $lang . '.png') }}"
                     class="w-5 h-3 mr-2" alt="{{ $lang }}">
                {{ strtoupper($lang) }}
            </a>
        @endif
    @endforeach
</div>
```

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
```
