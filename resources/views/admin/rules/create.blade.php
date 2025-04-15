@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/rules.create_rule') }}</h1>

    <form action="{{ route('admin.rules.store') }}" method="POST" class="space-y-4">
        @csrf

        @include('admin.rules.partials.form', ['submit' => __('admin/rules.create_rule')])
    </form>
@endsection
