@props([
    'meta' => [],
])

@php
    $title = $meta->title ? $meta->title . ' | ' . config('app.name') : config('app.name');
    $description = $meta->description ? $meta->description : config('app.description');
    $robots = $meta->robots ? 'index,follow' : 'noindex,nofollow';
    $ogImage = $meta->ogImage ? $meta->ogImage : null;

    $fontConfig = config('main.font');
    if (!empty($fontConfig) && !empty($fontConfig['url']) && !empty($fontConfig['family'])) {
        $fontsUrl = $fontConfig['url'];
        $fontFamily = $fontConfig['family'];
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="h-full antialiased light scroll-smooth filament js-focus-visible"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />
    <meta name="robots" content="{{ $robots }}" />

    <link rel="canonical" href="{{ trailing_slash_it(url()->current()) }}">

    <!-- Open Graph -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ config('brand.social_media.twitter') }}" />
    <meta name="twitter:creator" content="{{ config('brand.social_media.twitter') }}" />

    <meta property="og:url" content="{{ trailing_slash_it(url()->current()) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />

    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage->url }}" />
        <meta property="og:image:alt" content="{{ $ogImage->alt }}" />
        <meta property="og:image:width" content="{{ $ogImage->width }}" />
        <meta property="og:image:height" content="{{ $ogImage->height }}" />
    @endif

    @yield('meta')

    @if (!empty($fontsUrl))
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="{{ $fontsUrl }}" rel="stylesheet" />

        <style>
            body {
                font-family: '{{ $fontFamily }}', 'sans-serif';
            }
        </style>
    @endif

    <style>
        [x-cloak] {
            display: none !important;
        }

        :root {
            @foreach ($cssVariables ?? [] as $cssVariableName => $cssVariableValue)
                --{{ $cssVariableName }}: {{ $cssVariableValue }};
            @endforeach
        }
    </style>


    @livewireStyles
    @filamentStyles
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="text-base text-slate-950 dark:text-white dark:bg-slate-900">
    <x-skip-link />

    <x-headers.default :siteSettings="$siteSettings" :menu='$menu' />

    @yield('hero')

    {{ $slot }}

    <x-footers.default :siteSettings="$siteSettings" :menu='$menu' />
    <x-switch />
    @stack('scripts')
    @livewireScripts
    @filamentScripts
</body>

</html>
