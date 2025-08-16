<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">

    <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ ($title ?? 'Home') .' | '. config('app.name') }}</title>

    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <script>
        localStorage.getItem("_x_darkMode_on") === "true" &&
            document.documentElement.classList.add("dark");
    </script>

    @livewireStyles
    @vite(['resources/js/app.js'])

    @stack('stylesheets')

</head>

<body
    x-data
    x-bind="$store.global.documentBody"
    class="is-header-blur navigation:horizontal"
>

    <x-app-partials.app-preloader></x-app-partials.app-preloader>

    <div
      id="root"
      class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900"
      x-cloak
    >
        <!-- Sidebar -->
        {{-- <div class="sidebar print:hidden">
            <!-- Main Sidebar -->
            <x-app-partials.main-sidebar />

            <!-- Sidebar Panel -->
            <x-app-partials.sidebar-panel></x-app-partials.sidebar-panel>
        </div> --}}

        <!-- App Header -->
        <x-app-partials.header></x-app-partials.header>

        <!-- Mobile Searchbar -->
        <x-app-partials.mobile-searchbar></x-app-partials.mobile-searchbar>

        {{ $slot }}

    </div>

    <!--
  This is a place for Alpine.js Teleport feature
  @see https://alpinejs.dev/directives/teleport
-->
    <div id="x-teleport-target"></div>

    <div
        @notify.window="$notification({text: $event.detail.message, variant: $event.detail.type, position: 'center-top'})">

        <script>
            window.addEventListener('redirect', event => {
            setTimeout(function(){
                window.location = event.detail.url;
            }, 2000);
        });
        </script>

        {{-- @livewireScripts --}}
        @livewireScriptConfig

        @stack('scripts')

</body>

</html>
