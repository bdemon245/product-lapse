<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}"
    x-data="data()">
{{-- Include Haed part and CSS Link --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>{{ isset($title) ? $title : 'dashboard' }}</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer=""></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>

    <link rel="stylesheet" href="{{asset('css/windmil.output.css')}}">
    @include('layouts.global.styles')

    <style>
        .breadcrumb_area {
            padding: 1rem !important;
        }
    </style>


</head>

<body class="relative overflow-x-hidden targetedClass">
    {{-- Preloader --}}
    {{-- @include('layouts.frontend.preloader') --}}
    <div class="" id="tolink-1" >
        <div class="top-link"><a href="#tolink-1"><i class="ti-angle-up"></i></a></div>


        <div class="flex bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
            {{-- Desktop Sidebar --}}
            @include('layouts.admin.sidebar-desktop')
            {{-- Desktop Sidebar --}}

            {{-- BackDrop --}}
            <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
                style="display: none;"></div>
            {{-- BackDrop --}}

            {{-- Mobile Sidebar --}}
            @include('layouts.admin.sidebar-mobile')
            {{-- Mobile Sidebar --}}

            <div class="flex flex-col flex-1 w-full" id="hx-global-target">
                @include('layouts.admin.header')
                {{-- This is main content --}}
                <main>
                    @yield('main')
                </main>
                {{-- Include Footer Section --}}
            </div>
        </div>
    </div>
    @include('layouts.frontend.footer')
    {{-- Include Script --}}
    @include('layouts.frontend.script')
    @stack('scripts')
</body>

</html>
