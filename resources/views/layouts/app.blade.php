<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.0.1/dist/alpine.js" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://rsms.me">
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css"/>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900 antialiased font-sans">
<div>
  <div class="bg-gray-800 pb-32 mb-10">
    @include('layouts.top-navigation')
  </div>
  <main class="-mt-32">
    <div class="max-w-7xl mx-auto px-4 pb-12 sm:px-6 lg:px-8">

        @yield('content')

    </div>
  </main>
</div>

</body>
</html>
