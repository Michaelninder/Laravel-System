@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/users.create_user') }}</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        @include('admin.users.partials.form', ['submit' => __('admin/users.create_user')])
    </form>
@endsection
