@extends('layouts.forum')

@section('breadcrumb')
    <a href="{{ route('forum.overview') }}" class="hover:underline text-blue-600">{{ __('Forums') }}</a> /
    <a href="{{ route('forum.view', $forum) }}" class="hover:underline text-blue-600">{{ $forum->name }}</a> /
    <span>{{ $thread->title }}</span>
@endsection

@section('forum-content')
    <div class="flex justify-between items-start mb-4">
        <div>
            <h1 class="text-xl font-semibold">{{ $thread->title }}</h1>
            <p class="text-sm text-gray-500">
                {{ __('By') }} {{ $thread->user->username }} · {{ $thread->created_at->diffForHumans() }}
            </p>
        </div>

        <a href="{{ request()->url() }}" onclick="navigator.clipboard.writeText(this.href); alert('Link copied!'); return false;"
           class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm text-gray-700 rounded-md hover:bg-gray-100 transition">
            <i class="bi bi-share-fill mr-1"></i> {{ __('Share') }}
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

                <div class="flex {{ $isCurrentUser ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $isCurrentUser ? 'bg-blue-100' : 'bg-gray-100' }} rounded-lg max-w-xs w-full">
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
                          class="flex-grow border border-gray-300 rounded-md p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                          placeholder="{{ __('Write a comment...') }}"
                          rows="2"></textarea>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                    <i class="bi bi-send-fill mr-1"></i> {{ __('Send') }}
                </button>
            </div>
        </form>
    </div>
@endsection
