@extends('layouts.forum')

@section('forum-content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-800">{{ __('forum.title') }}</h1>
    </div>

    <div class="space-y-4">
        @forelse($forums as $forum)
            <div class="border border-gray-200 rounded p-4 bg-white flex justify-between items-start">
			    <div>
			        <a href="{{ route('forum.view', $forum) }}" class="text-lg font-medium text-blue-700 hover:underline">
			            {{ $forum->name }}
			        </a>
			        <p class="text-sm text-gray-600 mt-1">
			            {{ $forum->description }}
			        </p>
			    </div>
			
			    @if(auth()->user()?->isAdmin())
			        <div class="flex space-x-2">
			            <a href="{{ route('forum.edit', $forum) }}" class="text-sm text-yellow-500 hover:text-yellow-600 flex items-center">
			                <i class="bi bi-pencil-square mr-1"></i> {{ __('forum.edit') }}
			            </a>
			            <form method="POST" action="{{ route('forum.destroy', $forum->uuid) }}">
			                @csrf
			                @method('DELETE')
			                <button type="submit" onclick="return confirm('{{ __('forum.delete_confirm') }}')" class="text-sm text-red-600 hover:text-red-700 flex items-center">
			                    <i class="bi bi-trash3-fill mr-1"></i> {{ __('forum.delete') }}
			                </button>
			            </form>
			        </div>
			    @endif
			</div>
        @empty
            <p class="text-sm text-gray-500">{{ __('forum.no_forums') }}</p>
        @endforelse
    </div>
	@if(auth()->user()?->isAdmin())
    <a href="{{ route('forum.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium py-2 px-4 rounded transition mt-4">
      <i class="bi bi-plus-circle-fill text-lg"></i> {{ __('forum.create_forum') }}
    </a>
	@endif
@endsection


