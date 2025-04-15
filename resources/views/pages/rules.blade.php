@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">{{ __('pages/rules.title') }}</h1>

        <ul class="space-y-4">
		    @forelse($rules as $rule)
		        <li class="p-4 bg-white shadow rounded">
		            <h2 class="text-xl font-semibold">{{ $rule->title }}</h2>
		            <p class="text-gray-700 mt-2">{{ $rule->content }}</p>
		        </li>
		    @empty
		        <li class="text-gray-600 italic">{{ __('pages/rules.no_rules') }}</li>
		    @endforelse
		</ul>

    </div>
@endsection
