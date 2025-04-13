@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center text-center px-4">
        <h1 class="text-6xl font-bold text-red-500 mb-4">{{ $error }}</h1>
        <h2 class="text-2xl font-semibold mb-2">
            {{ __('errors.' . $error . '.title') }}
        </h2>
        <p class="text-gray-600">
            {{ __('errors.' . $error . '.description') }}
        </p>

        <a href="{{ route('pages.home') }}"
           class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            {{ __('errors.back_home') }}
        </a>
    </div>
@endsection
