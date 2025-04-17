<div class="w-64 hidden md:block p-4 border-r bg-white">
    <h2 class="font-semibold text-lg mb-4">
        {{ __('forum.sidebar_title') }}
    </h2>

    <ul class="space-y-2 text-sm">
        <li>
            <a href="{{ route('forum.overview') }}" class="text-gray-700 hover:text-blue-600 flex items-center">
                <i class="bi bi-grid mr-2"></i> {{ __('forum.all_forums') }}
            </a>
        </li>
    </ul>

    @auth
        <div class="mt-6">
            <p class="text-xs text-gray-500 uppercase mb-2">{{ __('forum.user_links') }}</p>
            <ul class="space-y-2 text-sm">
                <li>
                    <a href="{{ route('forum.my_threads') }}" class="text-gray-700 hover:text-blue-600 flex items-center">
                        <i class="bi bi-person-lines-fill mr-2"></i> {{ __('forum.my_threads') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('forum.thread.create') }}" class="text-gray-700 hover:text-blue-600 flex items-center">
                        <i class="bi bi-plus-square mr-2"></i> {{ __('forum.create_thread') }}
                    </a>
                </li>
            </ul>
        </div>

        @if(auth()->user()->isAdmin())
            <div class="mt-6">
                <p class="text-xs text-gray-500 uppercase mb-2">{{ __('forum.admin_links') }}</p>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('forum.create') }}" class="text-gray-700 hover:text-blue-600 flex items-center">
                            <i class="bi bi-gear-fill mr-2"></i> {{ __('forum.create_forum') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.forums.index') }}" class="text-gray-700 hover:text-blue-600 flex items-center">
                            <i class="bi bi-tools mr-2"></i> {{ __('forum.manage_forums') }}
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    @endauth
</div>
