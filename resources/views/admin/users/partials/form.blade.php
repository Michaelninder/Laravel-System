<div>
    <label>{{ __('admin/users.username') }}</label>
    <input type="text" name="username" class="w-full border p-2" value="{{ old('username', $user->username ?? '') }}">
</div>

<div>
    <label>{{ __('admin/users.email') }}</label>
    <input type="email" name="email" class="w-full border p-2" value="{{ old('email', $user->email ?? '') }}">
</div>

@if (!isset($user))
    <div>
        <label>{{ __('admin/users.password') }}</label>
        <input type="password" name="password" class="w-full border p-2">
    </div>

    <div>
        <label>{{ __('admin/users.password_confirmation') }}</label>
        <input type="password" name="password_confirmation" class="w-full border p-2">
    </div>
@endif

<div>
    <label>{{ __('admin/users.role') }}</label>
    <select name="role" class="w-full border p-2">
        <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
</div>

<button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">{{ $submit }}</button>
