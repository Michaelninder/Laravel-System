@extends('layouts.forum')

@section('breadcrumb')
    <a href="{{ route('forum.overview') }}" class="hover:underline">{{ __('Forums') }}</a> /
    <a href="{{ route('forum.view', $forum) }}" class="hover:underline">{{ $forum->name }}</a> /
    <span>{{ $thread->title }}</span>
@endsection

@section('forum-content')
    <div class="mb-6">
        <h1 class="text-xl font-semibold">{{ $thread->title }}</h1>
        <p class="text-sm text-gray-500">
            {{ __('By') }} {{ $thread->user->username }} · {{ $thread->created_at->diffForHumans() }}
        </p>
    </div>

    <div class="space-y-4">
        @foreach ($thread->comments as $comment)
            <div class="p-4 bg-white rounded shadow">
                <p class="text-sm text-gray-700 whitespace-pre-line">{{ $comment->body }}</p>
                <p class="text-xs text-gray-500 mt-2">
                    {{ $comment->user->username }} • {{ $comment->created_at->diffForHumans() }}
                </p>
            </div>
        @endforeach
    </div>
@endsection
