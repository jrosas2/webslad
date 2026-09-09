@props(['page', 'settings'])
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $page->meta_title ?: $page->title }}</title>
        <meta name="description" content="{{ $page->meta_description }}">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="es_CL">
        <meta property="og:title" content="{{ $page->meta_title ?: $page->title }}">
        <meta property="og:description" content="{{ $page->meta_description }}">
        <meta property="og:url" content="{{ url()->current() }}">
        @if (filled($settings['favicon_path'] ?? null))
            <link rel="icon" href="{{ asset('storage/'.$settings['favicon_path']) }}">
        @endif
        @if ($page->og_image)
            <meta property="og:image" content="{{ str($page->og_image)->startsWith(['http://', 'https://']) ? $page->og_image : asset('storage/'.$page->og_image) }}">
        @endif
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen overflow-x-hidden bg-slad-canvas font-sans text-slad-navy antialiased">
        <x-site.header :settings="$settings" />
        <main>{{ $slot }}</main>
        <x-site.footer :settings="$settings" />
    </body>
</html>
