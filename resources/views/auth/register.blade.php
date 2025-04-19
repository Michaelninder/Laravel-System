@extends('layouts.main')

@section('main')
<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-md">
    <h2 class="text-xl font-semibold mb-4 text-center">
        <i class="bi bi-person-plus-fill mr-1"></i> {{ __('auth.register') }}
    </h2>

    @if($errors->any())
        <div class="text-red-600 mb-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('auth.register.submit') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700">{{ __('auth.username') }}</label>
            <input type="text" name="username" class="w-full border px-3 py-2 rounded" value="{{ old('username') }}">
        </div>

        <div>
            <label class="block text-gray-700">{{ __('auth.email') }}</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" value="{{ old('email') }}">
        </div>

        <div>
            <label class="block text-gray-700">{{ __('auth.password') }}</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block text-gray-700">{{ __('auth.confirm_password') }}</label>
            <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="autologin" class="mr-2"> {{ __('auth.auto_login') }}
        </div>

        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded">
            <i class="bi bi-check2-circle mr-1"></i> {{ __('auth.register') }}
        </button>
    </form>
</div>
@endsection
