@extends('layouts.forum')

@section('breadcrumb')
    <a href="{{ route('forum.overview') }}">{{ __('Forums') }}</a>
    <span class="mx-1">/</span>
    <a href="{{ route('forum.view', $forum->uuid) }}">{{ $forum->name }}</a>
    <span class="mx-1">/</span>
    {{ __('Edit') }}
@endsection

@section('forum-content')
    <h1 class="text-xl font-semibold mb-4">
        <i class="bi bi-pencil-square me-2"></i> {{ __('Edit Forum') }}
    </h1>

    <form method="POST" action="{{ route('forum.update', $forum->uuid) }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-input w-full mt-1" value="{{ $forum->name }}" required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium">{{ __('Description') }}</label>
            <textarea name="description" id="description" rows="3" class="form-textarea w-full mt-1">{{ $forum->description }}</textarea>
        </div>

        <div>
            <label for="order_index" class="block text-sm font-medium">{{ __('Order Index') }}</label>
            <input type="number" name="order_index" id="order_index" class="form-input mt-1" value="{{ $forum->order_index }}">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_locked" id="is_locked" class="form-checkbox" {{ $forum->is_locked ? 'checked' : '' }}>
            <label for="is_locked" class="ml-2 text-sm">{{ __('Locked') }}</label>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            <i class="bi bi-save me-1"></i> {{ __('Save Changes') }}
        </button>
    </form>
@endsection
