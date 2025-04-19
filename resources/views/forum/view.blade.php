@extends('layouts.forum')

@section('breadcrumb')
    <a href="{{ route('forum.overview') }}" class="hover:underline">{{ __('Forums') }}</a>
    <span class="mx-1">/</span>
    <span>{{ $forum->name }}</span>
@endsection

@section('forum-content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold">{{ $forum->name }}</h1>

        @auth
            <a href="{{ route('forum.thread.create', $forum) }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium py-2 px-4 rounded transition">
                <i class="bi bi-plus-circle-fill text-lg"></i> {{ __('forum.create_thread') }}
            </a>
        @endauth
    </div>

    <div class="space-y-4">
        @forelse ($forum->threads as $thread)
            <div class="border border-gray-200 rounded p-4 bg-white flex justify-between items-start">
                <div>
                    <h2 class="font-semibold text-base">
					    <a href="{{ route('forum.thread.view', ['forum' => $forum->uuid, 'thread' => $thread->uuid]) }}" class="text-blue-600 hover:underline">
					        {{ $thread->title }}
					    </a>
					</h2>
					
					<p class="text-sm text-gray-700 mt-1">
					    {{ $thread->comments->first()?->body ?? __('No description available.') }}
					</p>
					
					<p class="text-sm text-gray-500">
					    {{ __('By') }} {{ $thread->user->username }} · {{ $thread->created_at->diffForHumans() }}
					</p>
                </div>

                @if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->uuid === $thread->user_uuid))
			        <div class="flex space-x-2">
                        <a href="{{ route('forum.thread.edit', $thread->uuid) }}" class="text-sm text-yellow-500 hover:text-yellow-600 flex items-center">
                            <i class="bi bi-pencil-square mr-1"></i> {{ __('strings.edit') }}
                        </a>
                        <form method="POST" action="{{ route('forum.thread.destroy', $thread->uuid) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('{{ __('forum.thread.delete_confirm') }}')" class="text-sm text-red-600 hover:text-red-700 flex items-center">
                                <i class="bi bi-trash3-fill mr-1"></i> {{ __('strings.delete') }}
                            </button>
                        </form>
					</div>
                @endif
            </div>
        @empty
            <p class="text-sm text-gray-600">{{ __('No threads yet.') }}</p>
        @endforelse
    </div>
@endsection
