<nav class="bg-white shadow py-3 px-6 flex justify-between items-center">
    {{-- Left section --}}
    <div class="flex items-center space-x-4">
        {{-- App Name / Icon --}}
        <span class="font-semibold text-lg text-blue-600">{{ env('APP_NAME') }}</span>

        @auth
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center text-gray-700 hover:text-blue-600">
                    <i class="bi bi-box-arrow-out mr-1"></i> {{ __('auth.logout') }}
                </button>
            </form>

            
    		@if(auth()->user()->isAdmin())
    		    <a href="{{ route('admin.overview') }}" class="text-gray-700 hover:text-blue-600">
    		        <i class="bi bi-shield-lock mr-1"></i> {{ __('strings.admin_dashboard') }}
    		    </a>
    		@endif
        @endauth
    </div>

    {{-- Right section --}}
    <div class="flex items-center space-x-4">
        @guest
            <a href="{{ route('auth.login') }}" class="flex items-center text-gray-700 hover:text-blue-600">
                <i class="bi bi-box-arrow-in-right mr-1"></i> {{ __('auth.login') }}
            </a>
            <a href="{{ route('auth.register') }}" class="flex items-center text-gray-700 hover:text-green-600">
                <i class="bi bi-person-plus-fill mr-1"></i> {{ __('auth.register') }}
            </a>
        @endguest

        {{-- Language Selector --}}
        <div x-data="{ open: false }" class="relative inline-block text-left">
            <button @click="open = !open" type="button"
                    class="inline-flex items-center border border-gray-300 rounded px-3 py-1 bg-white hover:bg-gray-100">
                <img src="{{ asset('img/SetLocale/' . app()->getLocale() . '.png') }}"
                     alt="{{ app()->getLocale() }}" class="w-5 h-3 mr-2">
                <span>{{ strtoupper(app()->getLocale()) }}</span>
                <i class="bi bi-chevron-down ml-2"></i>
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
