@extends('layouts.dashboard')

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white shadow p-6 rounded">
        <h1 class="text-xl font-bold mb-4">{{ __('dashboard/overview.title') }}</h1>

        <ul class="space-y-2 text-gray-700">
            <li><strong>{{ __('dashboard/overview.username') }}:</strong> {{ auth()->user()->username }}</li>
            <li><strong>{{ __('dashboard/overview.email') }}:</strong> {{ auth()->user()->email }}</li>
            <li><strong>{{ __('dashboard/overview.uuid') }}:</strong> {{ auth()->user()->uuid }}</li>
            <li><strong>{{ __('dashboard/overview.role') }}:</strong> {{ auth()->user()->role }}</li>
            <li><strong>{{ __('dashboard/overview.created_at') }}:</strong> {{ auth()->user()->created_at->format('d.m.Y H:i') }}</li>
            <li><strong>{{ __('dashboard/overview.balance') }}:</strong> {{ number_format(auth()->user()->balance, 2) }} €</li>
        </ul>
    </div>
@endsection
