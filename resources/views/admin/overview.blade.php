@extends('layouts.dashboard')

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white shadow p-6 rounded">
        <h1 class="text-xl font-bold mb-4">{{ __('admin/overview.title') }}</h1>

        <p class="text-gray-700">{{ __('admin/overview.welcome') }}</p>
    </div>
@endsection
