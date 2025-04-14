@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/users.edit_user') }}</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @include('admin.users.partials.form', ['submit' => __('admin/users.update_user')])
    </form>
@endsection
