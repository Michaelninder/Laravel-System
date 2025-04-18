@extends('layouts.forum')

@section('breadcrumb')
    <a href="{{ route('forum.overview') }}">{{ __('Forums') }}</a> / {{ __('Create') }}
@endsection

@section('forum-content')
    <h1 class="text-xl font-semibold mb-4">
        <i class="bi bi-plus-circle me-2"></i> {{ __('Create Forum') }}
    </h1>

    <form method="POST" action="{{ route('forum.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-input w-full mt-1" required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium">{{ __('Description') }}</label>
            <textarea name="description" id="description" rows="3" class="form-textarea w-full mt-1"></textarea>
        </div>

        <div>
            <label for="order_index" class="block text-sm font-medium">{{ __('Order Index') }}</label>
            <input type="number" name="order_index" id="order_index" class="form-input mt-1">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="bi bi-check-circle me-1"></i> {{ __('Create') }}
        </button>
    </form>
@endsection
