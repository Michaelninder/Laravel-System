<ul class="space-y-4">
    @forelse($rules as $rule)
        <li class="p-4 bg-white shadow rounded flex justify-between">
            <div>
                <h2 class="font-semibold">{{ $rule->title }}</h2>
                <p class="text-gray-600">{{ $rule->content }}</p>
            </div>
            <a href="{{ route('admin.rules.edit', $rule) }}" class="text-blue-600">{{ __('admin/rules.edit') }}</a>
        </li>
    @empty
        <li class="text-gray-600 italic">{{ __('admin/rules.no_rules') }}</li>
    @endforelse
</ul>
