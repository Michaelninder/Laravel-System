@extends('layouts.dashboard')

@section('content')
<div class="grid grid-cols-3 gap-6 mt-2">
    <div class="col-span-2 bg-white rounded-lg shadow p-4 flex flex-col justify-between h-[75vh]">
        <div class="flex-grow overflow-y-auto max-h-[60vh] space-y-3 pr-2">
            @foreach ($messages as $message)
				@if ($ticket->user_uuid == $message->user_uuid)
					<div class="flex justify-end">
				@else
					<div class="flex justify-start">
				@endif
					@if (auth()->user()->uuid == $message->user_uuid)
						<div class="bg-blue-100 rounded-lg">
					@else
						<div class="bg-gray-100 rounded-lg">
					@endif
        					<div class="p-3 rounded-lg max-w-xs">
        					    <p class="font-semibold text-gray-800">{{ $message->user->username }}</p>
        					    <p class="text-sm">{!! nl2br(e($message->message)) !!}</p>
        					    <span class="text-xs block mt-1 text-right text-gray-500">
        					        {{ $message->created_at->format('d.m.Y H:i') }}
        					    </span>
        					</div>
                    	</div>
                	</div>
            @endforeach
        </div>

        <!-- Bottom Extendable Textarea -->
        <form method="POST" action="{{ route('support.send', $ticket->uuid) }}" class="mt-4 flex flex-col">
            @csrf
            <textarea name="message" class="flex-grow border rounded-lg px-3 py-2 resize-y max-h-36" placeholder="{{ __('support.type_message') }}" required></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg mt-2 self-end">{{ __('support.send') }}</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="font-bold text-lg mb-4">{{ __('support.ticket_information') }}</h2>
        <ul class="text-sm space-y-2 text-gray-700">
            <li><strong>{{ __('support.subject') }}:</strong> {{ $ticket->subject }}</li>
            <li><strong>{{ __('support.status') }}:</strong>
                <span class="px-2 py-1 rounded bg-{{ $ticket->status === 'open' ? 'green' : ($ticket->status === 'closed' ? 'red' : ($ticket->status === 'pending' ? 'orange' : 'gray')) }}-200 text-{{ $ticket->status === 'open' ? 'green' : ($ticket->status === 'closed' ? 'red' : ($ticket->status === 'pending' ? 'orange' : 'gray')) }}-800">
                    {{ ucfirst($ticket->status) }}
                </span>
            </li>
            <li><strong>{{ __('support.user') }}:</strong> {{ $ticket->user->username ?? $ticket->user_uuid }}</li>
            <li><strong>{{ __('support.user_uuid') }}:</strong> {{ $ticket->user_uuid }}</li>
            <li><strong>{{ __('support.ticket_uuid') }}:</strong> {{ $ticket->uuid }}</li>
            <li><strong>{{ __('support.created_at') }}:</strong> {{ $ticket->created_at->format('d.m.Y H:i') }}</li>
            <li><strong>{{ __('support.last_activity') }}:</strong> {{ $ticket->updated_at->format('d.m.Y H:i') }}</li>
        </ul>
		<div class="flex gap-2 mt-4">
		    @if($ticket->status === 'closed')
		        <form method="POST" action="{{ route('support.updateStatus', ['ticket' => $ticket->uuid, 'status' => 'open']) }}">
		            @csrf
		            <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700">
		                <i class="bi bi-arrow-repeat me-5"></i> {{ __('support.reopen_ticket') }}
		            </button>
		        </form>
		    @else
		        <form method="POST" action="{{ route('support.updateStatus', ['ticket' => $ticket->uuid, 'status' => 'closed']) }}">
		            @csrf
		            <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700">
		                <i class="bi bi-x-circle me-5"></i> {{ __('support.close_ticket') }}
		            </button>
		        </form>
		    @endif
		
		    @if(auth()->user()->isAdmin() && $ticket->status !== 'pending')
		        <form method="POST" action="{{ route('support.updateStatus', ['ticket' => $ticket->uuid, 'status' => 'pending']) }}">
		            @csrf
		            <button type="submit" class="inline-flex items-center px-3 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600">
		                <i class="bi bi-hourglass-split me-5"></i> {{ __('support.set_pending') }}
		            </button>
		        </form>
		    @endif
		</div>
    </div>
</div>
@endsection
