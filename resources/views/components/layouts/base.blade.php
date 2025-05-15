<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">

    <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ($meta_title ?? 'Login') .' | '. config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
        <!-- CSS & JS Assets -->

    @livewireStyles
    @vite(['resources/js/app.js'])

    <script>
        /**
         * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
         */
        localStorage.getItem("_x_darkMode_on") === "true" &&
            document.documentElement.classList.add("dark");
    </script>

    @stack('stylesheets')

</head>

<body x-data x-bind="$store.global.documentBody"
    class="
        @isset($isSidebarOpen)
            {{ $isSidebarOpen === 'true' ? 'is-sidebar-open' : '' }}
        @endisset
        @isset($isHeaderBlur)
            {{ $isHeaderBlur === 'true' ? 'is-header-blur' : '' }}
        @endisset
        @isset($hasMinSidebar)
            {{ $hasMinSidebar === 'true' ? 'has-min-sidebar' : '' }}
        @endisset
        @isset($headerSticky)
            {{ $headerSticky === 'false' ? 'is-header-not-sticky' : '' }}
        @endisset">

    <!-- App preloader-->
    <x-app-partials.app-preloader></x-app-partials.app-preloader>

    <!-- Page Wrapper -->

    @if (isset($withOutRoot))
        {{ $slot }}
    @else
        <div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak>

            {{ $slot }}

        </div>
    @endif

    <!--
  This is a place for Alpine.js Teleport feature
  @see https://alpinejs.dev/directives/teleport
-->
    <div id="x-teleport-target"></div>

    <div @notify.window="$notification({text: $event.detail.message, variant: $event.detail.type, position: 'center-top'})">

    {{-- @livewireScripts --}}
    @livewireScriptConfig

    @stack('scripts')

</body>

</html>
