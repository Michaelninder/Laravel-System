@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">{{ __('support.create_ticket') }}</h1>

    <form action="{{ route('support.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1">{{ __('support.subject') }}</label>
            <input type="text" name="subject" class="w-full border p-2" value="{{ old('subject') }}" required>
        </div>

        <div>
            <label class="block mb-1">{{ __('support.theme') }} ({{ __('strings.optional') }})</label>
            <input type="text" name="theme" class="w-full border p-2" value="{{ old('theme') }}">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ __('support.create_ticket') }}
        </button>
    </form>
</div>
@endsection
