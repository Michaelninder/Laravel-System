# Some Code Samples:

### Lang Switcher based on the lang resource folders
```php

<div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-28 bg-white border rounded shadow-lg z-50">
    @foreach(File::exists(resource_path('lang')) ? File::directories(resource_path('lang')) : [] as $langDir)
        @php $lang = basename($langDir); @endphp
        @if($lang !== app()->getLocale())
            <a href="{{ url('/set-locale/' . $lang) }}" class="flex items-center px-3 py-2 hover:bg-gray-100 text-sm">
                <img src="{{ asset('img/SetLocale/' . $lang . '.png') }}" class="w-5 h-3 mr-2" alt="{{ $lang }}">
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

### Forum Thread View
```php
<div class="flex justify-between items-start mb-4">
        <div>
            <h1 class="text-xl font-semibold">{{ $thread->title }}</h1>
            <p class="text-sm text-gray-500">
                {{ __('By') }} {{ $thread->user->username }} · {{ $thread->created_at->diffForHumans() }}
            </p>
        </div>

        <a href="{{ request()->url() }}" onclick="navigator.clipboard.writeText(this.href); alert('Link copied!'); return false;"
           class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-share-fill"></i> {{ __('Share') }}
        </a>
    </div>

    <div class="col-span-2 bg-white rounded-lg shadow p-4 flex flex-col justify-between h-[75vh]">
        <div class="flex-grow overflow-y-auto max-h-[60vh] space-y-3 pr-2">
            @foreach ($thread->comments as $comment)
                @php
                    $isCurrentUser = auth()->check() && auth()->user()->uuid === $comment->user_uuid;
                    $votesUp = $comment->votes->where('is_upvote', true)->count();
                    $votesDown = $comment->votes->where('is_upvote', false)->count();
                @endphp

                <div class="flex {{ $isCurrentUser ? 'justify-end' : 'justify-start' }}"> //comments of the currently logged-in user are on left and ALL other comments on the right
                    <div class="{{ $isCurrentUser ? 'bg-blue-100' : 'bg-gray-100' }} rounded-lg max-w-xs w-full"> //messages of the auth user are blue
                        <div class="p-3 rounded-lg">
                            <p class="font-semibold text-gray-800">{{ $comment->user->username }}</p>
                            <p class="text-sm whitespace-pre-line">{{ $comment->body }}</p>
                            <div class="flex items-center justify-between mt-2 text-xs text-gray-500">
                                <span>{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('forum.comment.vote', ['comment' => $comment->uuid, 'type' => 'up']) }}" method="POST">
                                        @csrf
                                        <button class="text-green-600 hover:text-green-700" title="Upvote">
                                            <i class="bi bi-hand-thumbs-up-fill"></i> {{ $votesUp }}
                                        </button>
                                    </form>
                                    <form action="{{ route('forum.comment.vote', ['comment' => $comment->uuid, 'type' => 'down']) }}" method="POST">
                                        @csrf
                                        <button class="text-red-600 hover:text-red-700" title="Downvote">
                                            <i class="bi bi-hand-thumbs-down-fill"></i> {{ $votesDown }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('forum.comment.store', ['thread' => $thread->uuid]) }}" method="POST" class="mt-4">
            @csrf
            <div class="flex items-center gap-2">
                <textarea name="body" required
                          class="form-control flex-grow"
                          placeholder="{{ __('Write a comment...') }}"
                          rows="2"></textarea>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send-fill"></i> {{ __('Send') }}
                </button>
            </div>
        </form>
    </div>
```
