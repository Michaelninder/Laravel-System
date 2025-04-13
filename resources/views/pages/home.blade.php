@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex flex-col items-center">
            <h1 class="text-3xl font-bold mb-4">{{ __('pages/home.welcome_title') }}</h1>
            <p class="text-lg mb-4">{{ __('pages/home.welcome_description') }}</p>

            @auth
                <p class="text-lg mb-4">{{ __('pages/home.logged_in_as', ['username' => auth()->user()->username]) }}</p>
                <a href="{{ route('dashboard.overview') }}" class="text-blue-600">{{ __('pages/home.go_to_dashboard') }}</a>
            @else
                <a href="{{ route('auth.login') }}" class="text-blue-600">{{ __('auth.login') }}</a>
                <a href="{{ route('auth.register') }}" class="text-blue-600">{{ __('auth.register') }}</a>
            @endauth
        </div>
    </div>
@endsection
