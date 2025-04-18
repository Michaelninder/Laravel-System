@extends('layouts.forum')

@section('breadcrumb')
    <a href="{{ route('forum.overview') }}" class="hover:underline">{{ __('Forums') }}</a>
    <span class="mx-1">/</span>
    <span>{{ $forum->name }}</span>
@endsection

@section('forum-content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-semibold">{{ $forum->name }}</h1>
    </div>

    <div class="space-y-4">
        @forelse ($forum->threads as $thread)
            <div class="p-4 bg-white rounded shadow hover:bg-gray-50">
                <h2 class="font-semibold text-base">{{ $thread->title }}</h2>
                <p class="text-sm text-gray-500">
                    {{ __('By') }} {{ $thread->user->username }} · {{ $thread->created_at->diffForHumans() }}
                </p>
            </div>
        @empty
            <p class="text-sm text-gray-600">{{ __('No threads yet.') }}</p>
        @endforelse
    </div>
	@auth
	<a href="{{ route('forum.thread.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium py-2 px-4 rounded transition mt-4">
      <i class="bi bi-plus-circle-fill text-lg"></i> {{ __('forum.create_thread') }}
    </a>
	@endauth
@endsection
