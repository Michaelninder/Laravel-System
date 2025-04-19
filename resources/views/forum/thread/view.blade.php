@extends('layouts.forum')

@section('breadcrumb')
    <a href="{{ route('forum.overview') }}" class="hover:underline">{{ __('Forums') }}</a> /
    <a href="{{ route('forum.view', $forum) }}" class="hover:underline">{{ $forum->name }}</a> /
    <span>{{ $thread->title }}</span>
@endsection

@section('forum-content')
    <div class="flex flex-col gap-4 h-[75vh] bg-white rounded-lg shadow p-4">
        <div class="mb-2">
            <h1 class="text-xl font-semibold">{{ $thread->title }}</h1>
            <p class="text-sm text-gray-500">
                {{ __('By') }} {{ $thread->user->username }} · {{ $thread->created_at->diffForHumans() }}
            </p>
        </div>

        <div class="flex-grow overflow-y-auto max-h-[60vh] space-y-3 pr-2">
            @foreach ($thread->comments as $comment)
                @if (auth()->user()?->uuid === $comment->user_uuid)
                    <div class="flex justify-end">
                        <div class="bg-blue-100 rounded-lg">
                            <div class="p-3 rounded-lg max-w-xs">
                                <p class="font-semibold text-gray-800">{{ $comment->user->username }}</p>
                                <p class="text-sm whitespace-pre-line">{!! nl2br(e($comment->body)) !!}</p>
                                <span class="text-xs block mt-1 text-right text-gray-500">
                                    {{ $comment->created_at->format('d.m.Y H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-start">
                        <div class="bg-gray-100 rounded-lg">
                            <div class="p-3 rounded-lg max-w-xs">
                                <p class="font-semibold text-gray-800">{{ $comment->user->username }}</p>
                                <p class="text-sm whitespace-pre-line">{!! nl2br(e($comment->body)) !!}</p>
                                <span class="text-xs block mt-1 text-right text-gray-500">
                                    {{ $comment->created_at->format('d.m.Y H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
