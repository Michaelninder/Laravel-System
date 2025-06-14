<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
	
	<!-- Preloader -->
	<link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
</head>
<body class="bg-gray-100">
	
	<div id="preloader">
	  <div class="spinner"></div>
	</div>

    @include('components.navbar')

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-6 my-4">
            <strong>Error:</strong> {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mx-6 my-4">
            <strong>Success:</strong> {{ session('success') }}
        </div>
    @endif
    
    <!--main class="min-h-screen flex items-center justify-center py-8"-->
	<main class="min-h-screen py-8 px-6">
	    @yield('content')
	</main>

    @include('components.footer')

    <script src="//unpkg.com/alpinejs" defer></script>
	<script>
	  window.addEventListener("load", function () {
	    const preloader = document.getElementById("preloader");
	    preloader.style.display = "none";
	  });
	</script>
</body>
</html>

