@extends('layouts.dashboard')

@section('content')
    <div class="max-w-7xl mx-auto mt-2">
        <div class="mb-6 flex items-center border border-gray-300 rounded-lg overflow-hidden">
            <a href="{{ route('support.overview') }}"
               class="whitespace-nowrap py-3.5 px-3 text-sm transition-colors text-center rounded-l-md {{ !request('status') ? 'bg-minehoster-200/60 text-minehoster-600 font-semibold' : 'text-gray-400 hover:bg-minehoster-200/60 hover:text-minehoster-600' }}">
                {{ __('support.all_tickets') }}
            </a>

            <a href="{{ route('support.overview', ['status' => 'open']) }}"
               class="whitespace-nowrap py-3.5 px-3 text-sm transition-colors text-center rounded-l-md {{ request('status') === 'open' ? 'bg-minehoster-200/60 text-minehoster-600 font-semibold' : 'text-gray-400 hover:bg-minehoster-200/60 hover:text-minehoster-600' }}">
                {{ __('support.open_tickets') }}
            </a>

            <a href="{{ route('support.overview', ['status' => 'closed']) }}"
               class="whitespace-nowrap py-3.5 px-3 text-sm transition-colors text-center rounded-r-md {{ request('status') === 'closed' ? 'bg-minehoster-200/60 text-minehoster-600 font-semibold' : 'text-gray-400 hover:bg-minehoster-200/60 hover:text-minehoster-600' }}">
                {{ __('support.closed_tickets') }}
            </a>
        </div>

        <div class="bg-white shadow ring-1 ring-gray-300 rounded-lg">
            <div class="overflow-x-auto">
                <table class="table-fixed w-full">
                    <thead class="bg-gray-100">
					    <tr>
					        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">
					            {{ __('support.subject') }}
					        </th>
					        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">
					            {{ __('support.status') }}
					        </th>
					        @if(auth()->user()->isAdmin())
					            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">
					                {{ __('support.user') }}
					            </th>
					        @endif
					        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">
					            {{ __('support.created_at') }}
					        </th>
					        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">
					            {{ __('support.last_activity') }}
					        </th>
					        <th class="px-4 py-3 text-right text-sm font-semibold text-gray-900">
					            {{ __('strings.actions') }}
					        </th>
					    </tr>
					</thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('support.view', $ticket->uuid) }}"
                                       class="text-gray-600 hover:text-blue-500 font-medium">
                                        {{ $ticket->subject }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="inline-block px-2 py-0.5 rounded-md text-xs font-semibold
                                        @if($ticket->status === 'open') bg-green-100 text-green-800 border border-green-200
                                        @elseif($ticket->status === 'pending') bg-orange-100 text-orange-800 border border-orange-200
                                        @else bg-red-100 text-red-800 border border-red-200
                                        @endif">
                                        {{ __('support.status_'.$ticket->status) }}
                                    </span>
                                </td>
                                @if(auth()->user()->isAdmin())
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $ticket->user->username ?? $ticket->user_uuid }}
                                </td>
                                @endif
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $ticket->created_at->diffForHumans() }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $ticket->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-4 py-3 text-right text-sm">
                                    <a href="{{ route('support.view', $ticket->uuid) }}"
                                       class="text-minehoster-600 hover:text-minehoster-500 font-medium text-xs">
                                        {{ __('support.view') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500 text-sm">
                                    {{ __('support.no_tickets') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $tickets->withQueryString()->links() }}
        </div>

        <a href="{{ route('support.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium py-2 px-4 rounded transition mt-4">
            <i class="bi bi-plus-circle-fill text-lg"></i>
            {{ __('support.create_ticket') }}
        </a>
    </div>
@endsection
