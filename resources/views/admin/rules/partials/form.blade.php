<div>
    <label>{{ __('admin/rules.title') }}</label>
    <input type="text" name="title" class="w-full border p-2" value="{{ old('title', $rule->title ?? '') }}">
</div>

<div>
    <label>{{ __('admin/rules.content') }}</label>
    <textarea name="content" class="w-full border p-2">{{ old('content', $rule->content ?? '') }}</textarea>
</div>

<div>
    <label>{{ __('admin/rules.order_index') }}</label>
    <input type="number" name="order_index" class="w-full border p-2" value="{{ old('order_index', $rule->order_index ?? '') }}">
</div>

<button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">{{ $submit }}</button>
