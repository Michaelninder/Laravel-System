@extends('layouts.forum')

@section('breadcrumb')
    <a href="{{ route('forum.overview') }}">{{ __('Forums') }}</a> /
    <a href="{{ route('forum.view', $forum) }}">{{ $forum->name }}</a> /
    {{ __('Create Thread') }}
@endsection

@section('forum-content')
    <h1 class="text-xl font-semibold mb-4">
        <i class="bi bi-plus-circle me-2"></i> {{ __('Create Thread in') }} {{ $forum->name }}
    </h1>

    <form method="POST" action="{{ route('forum.thread.store') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="forum_uuid" value="{{ $forum->uuid }}">

        <div>
            <label for="title" class="block text-sm font-medium">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" class="form-input w-full mt-1" required>
        </div>

        <div>
            <label for="message" class="block text-sm font-medium">{{ __('Message') }}</label>
            <textarea name="message" id="message" rows="8" class="form-textarea w-full mt-1" placeholder="{{ __('Start the discussion...') }}" required></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="bi bi-check-circle me-1"></i> {{ __('Post Thread') }}
        </button>
    </form>
@endsection
