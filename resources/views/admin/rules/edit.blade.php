@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/rules.edit_rule') }}</h1>

    <form action="{{ route('admin.rules.update', $rule) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @include('admin.rules.partials.form', ['submit' => __('admin/rules.update_rule')])
    </form>
@endsection
