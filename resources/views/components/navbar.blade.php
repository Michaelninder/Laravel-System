<nav class="bg-white shadow py-3 px-6 flex justify-between items-center">
    <div class="flex items-center space-x-6">
        <a href="{{ route('pages.home') }}" class="font-semibold text-lg text-blue-600 hover:text-blue-800">
            {{ env('APP_NAME') }}
        </a>

        <a href="{{ route('pages.rules') }}" class="flex items-center text-gray-700 hover:text-blue-600 text-sm">
            <i class="bi bi-journal-text mr-2 text-base"></i> {{ __('rules.title') }}
        </a>

        @auth
         <a href="{{ route('support.overview') }}" class="flex items-center text-gray-700 hover:text-blue-600 text-sm">
             <i class="bi bi-headset mr-2 text-base"></i> {{ __('support.title') }}
         </a>
        @endauth

        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                    class="flex items-center text-red-600 hover:text-red-700 text-sm focus:outline-none">
                <i class="bi bi-exclamation-triangle mr-1 text-base"></i> Errors
                <i class="bi bi-chevron-down ml-1 text-xs"></i>
            </button>

            <div x-show="open" @click.away="open = false" x-transition
                 class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
                @php $errors = ['403', '404', '419', '429', '500', '503']; @endphp
                @foreach($errors as $err)
                    <a href="{{ route('errors.custom', $err) }}"
                       class="flex items-start gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b last:border-b-0">
                        <i class="bi bi-bug-fill text-red-600 mt-0.5"></i>
                        <div>
                            <span class="font-medium">Error {{ $err }}</span><br>
                            <span class="text-xs text-gray-500">{{ __('errors.' . $err . '.title') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
	
    	<div x-data="{ open: false }" class="relative">
		    <button @click="open = !open"
		            class="flex items-center text-gray-700 hover:text-blue-600 text-sm focus:outline-none">
		        <i class="bi bi-chat-left-text mr-2 text-base"></i> {{ __('forums.title') }}
		        <i class="bi bi-chevron-down ml-1 text-xs"></i>
		    </button>
		
		    <div x-show="open" @click.away="open = false" x-transition
		         class="absolute left-0 mt-2 w-56 bg-white border border-gray-200 rounded shadow-lg z-50 max-h-64 overflow-y-auto">
		        <a href="{{ route('forum.overview') }}"
		           class="flex items-start gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b">
		            <i class="bi bi-layout-text-window text-blue-600 mt-0.5"></i>
		            <span>{{ __('forums.overview') }}</span>
		        </a>
		        @foreach($forums as $forum)
		            <a href="{{ route('forum.view', $forum) }}"
		               class="flex items-start gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b last:border-b-0">
		                <i class="bi bi-chat-dots-fill text-gray-500 mt-0.5"></i>
		                <span>{{ $forum->name }}</span>
		            </a>
		        @endforeach
		    </div>
		</div>
    </div>

    <div class="flex items-center space-x-4">
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.overview') }}" class="flex items-center text-gray-700 hover:text-blue-600 text-sm">
                    <i class="bi bi-shield-lock mr-2 text-base"></i> {{ __('strings.admin_dashboard') }}
                </a>
            @endif

            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center text-gray-700 hover:text-red-600 text-sm">
                    <i class="bi bi-box-arrow-right mr-2 text-base"></i> {{ __('auth.logout') }}
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('auth.login') }}" class="flex items-center text-gray-700 hover:text-blue-600 text-sm">
                <i class="bi bi-box-arrow-in-right mr-2 text-base"></i> {{ __('auth.login') }}
            </a>
            <a href="{{ route('auth.register') }}" class="flex items-center text-gray-700 hover:text-green-600 text-sm">
                <i class="bi bi-person-plus-fill mr-2 text-base"></i> {{ __('auth.register') }}
            </a>
        @endguest

        <div x-data="{ open: false }" class="relative inline-block text-left">
            <button @click="open = !open" type="button"
                    class="inline-flex items-center border border-gray-300 rounded px-3 py-1 bg-white hover:bg-gray-100 text-sm">
                <img src="{{ asset('img/SetLocale/' . app()->getLocale() . '.png') }}"
                     alt="{{ app()->getLocale() }}" class="w-5 h-3 mr-2">
                <span>{{ strtoupper(app()->getLocale()) }}</span>
                <i class="bi bi-chevron-down ml-2 text-xs"></i>
            </button>

            <div x-show="open" @click.away="open = false"
                 x-transition
                 class="absolute right-0 mt-2 w-28 bg-white border rounded shadow-lg z-50">
                @foreach(File::exists(resource_path('lang')) ? File::directories(resource_path('lang')) : [] as $langDir)
                    @php $lang = basename($langDir); @endphp
                    @if($lang !== app()->getLocale())
                        <a href="{{ url('/set-locale/' . $lang) }}"
                           class="flex items-center px-3 py-2 hover:bg-gray-100 text-sm">
                            <img src="{{ asset('img/SetLocale/' . $lang . '.png') }}"
                                 class="w-5 h-3 mr-2" alt="{{ $lang }}">
                            {{ strtoupper($lang) }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</nav>
