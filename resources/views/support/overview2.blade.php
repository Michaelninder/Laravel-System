@extends('layouts.dashboard')

@section('content')
    <div class="max-w-6xl mx-auto mt-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">{{ __('support.my_tickets') }}</h1>

            <a href="{{ route('support.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow hover:bg-blue-700 transition">
                <i class="bi bi-plus-circle mr-2"></i> {{ __('support.create_ticket') }}
            </a>
        </div>

        @if ($tickets->isEmpty())
            <div class="text-center text-gray-600">
                <i class="bi bi-inbox-fill text-3xl mb-2 text-gray-400"></i>
                <p>{{ __('support.no_tickets') }}</p>
            </div>
        @else
            <div class="grid gap-4">
                @foreach ($tickets as $ticket)
                    <a href="{{ route('support.view', $ticket->uuid) }}"
                       class="block p-4 bg-white shadow rounded hover:bg-gray-50 transition duration-200">
                        {{-- Row 1: Subject + Status --}}
                        <div class="flex justify-between items-center mb-1">
                            <h2 class="font-semibold flex items-center gap-2 text-lg">
                                <i class="bi bi-chat-left-text text-gray-500"></i>
                                {{ $ticket->subject }}
                            </h2>
                            <span class="text-sm px-2 py-1 rounded bg-{{ $ticket->status === 'open' ? 'green' : 'gray' }}-200 text-{{ $ticket->status === 'open' ? 'green' : 'gray' }}-800">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </div>

                        {{-- Row 2: User + Last Activity --}}
                        <div class="flex justify-between text-sm text-gray-600">
                            @if(auth()->user()->isAdmin())
                                <div>
                                    <i class="bi bi-person-badge"></i> {{ $ticket->user->username ?? $ticket->user_uuid }}
                                </div>
                            @endif
                            <div class="ml-auto">
                                <i class="bi bi-clock"></i> {{ $ticket->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
