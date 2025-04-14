@extends('layouts.admin')

@section('admin-content')
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/users.user_list') }}</h1>

    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        {{ __('admin/users.create_user') }}
    </a>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">ID</th>
                <th class="border p-2">{{ __('admin/users.username') }}</th>
                <th class="border p-2">{{ __('admin/users.email') }}</th>
                <th class="border p-2">{{ __('admin/users.role') }}</th>
                <th class="border p-2">{{ __('admin/users.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border p-2">{{ $user->id }}</td>
                    <td class="border p-2">{{ $user->username }}</td>
                    <td class="border p-2">{{ $user->email }}</td>
                    <td class="border p-2">{{ $user->role }}</td>
                    <td class="border p-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline">
                            {{ __('admin/users.edit') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
