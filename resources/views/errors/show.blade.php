@extends('layouts.app')

@php
    $all_errors = $all_errors ?? ['403', '404', '419', '429', '500', '503'];
@endphp

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 bg-gray-100">
        <div class="bg-white shadow-md rounded-lg w-full max-w-3xl p-8 text-center">
            <div class="mb-6">
                <h1 class="text-6xl font-bold text-red-600 flex items-center justify-center gap-3">
                    <i class="bi bi-exclamation-triangle-fill text-5xl"></i> {{ $error }}
                </h1>
            </div>

            <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                {{ __('errors.' . $error . '.title') }}
            </h2>

            <p class="text-gray-600 mb-6">
                {{ __('errors.' . $error . '.description') }}
            </p>

            <div class="mb-8">
                <a href="{{ route('pages.home') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded hover:bg-blue-700 transition">
                    <i class="bi bi-house-door-fill"></i> {{ __('errors.back_home') }}
                </a>
            </div>

            <div class="text-left">
                <h4 class="text-lg font-medium text-gray-700 mb-4 flex items-center gap-2">
                    <i class="bi bi-list-ul"></i> {{ __('Other Error Pages') }}
                </h4>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border-b border-gray-200">
                                    <i class="bi bi-shield-exclamation"></i> Code
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border-b border-gray-200">Title</th>
                                <th class="px-4 py-2 text-center text-sm font-semibold text-gray-600 border-b border-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_errors as $all_error)
                                @if ($all_error !== $error)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-t border-gray-200">
                                            <span class="inline-block px-2 py-1 text-sm bg-red-100 text-red-700 rounded">
                                                {{ $all_error }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 border-t border-gray-200">
                                            {{ __('errors.' . $all_error . '.title') }}
                                        </td>
                                        <td class="px-4 py-2 text-center border-t border-gray-200">
                                            <a href="{{ route('errors.custom', $all_error) }}"
                                               class="inline-flex items-center gap-1 text-sm text-gray-700 border border-gray-300 rounded px-3 py-1 hover:bg-gray-100 transition">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
