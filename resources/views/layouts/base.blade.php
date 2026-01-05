<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Perfect Plataforma 360')</title>

    <meta name="theme-color" content="#000000">
    <meta name="color-scheme" content="dark">
    <meta name="description"
          content="Perfect Plataforma 360 — experiências imersivas para o seu evento: plataforma 360, túnel de LED, totem móvel e cabine espelhada 3D.">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="Perfect Plataforma 360">
    <meta property="og:description" content="Experiências imersivas para o seu evento.">
    <meta property="og:image" content="{{ asset('icones/og-image.png') }}">
    <meta property="og:locale" content="pt_BR">

    {{-- CDN --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CSS local (cache busting) --}}
    <link rel="stylesheet"
          href="{{ asset('css/index.css') }}?v={{ now()->timestamp }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icones/perfect-favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('icones/perfect-favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icones/perfect-favicon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('icones/perfect-favicon-512x512.png') }}">
    <link rel="shortcut icon" href="{{ asset('icones/perfect-favicon.ico') }}">

    {{-- Extra HEAD (equivalente ao block head_extra) --}}
    @stack('head_extra')
</head>

<body class="bg-black text-white">

    {{-- Conteúdo principal --}}
    @yield('content')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    {{-- Expor STATIC_URL para JS (equivalente ao get_static_prefix) --}}
    <script>
        window.STATIC_URL = "{{ asset('') }}";
    </script>

    {{-- Scripts locais (cache busting) --}}
    <script src="{{ asset('js/galleries-config.js') }}?v={{ now()->timestamp }}" defer></script>
    <script src="{{ asset('js/services-gallery.js') }}?v={{ now()->timestamp }}" defer></script>
    <script src="{{ asset('js/video-carousel.js') }}?v={{ now()->timestamp }}" defer></script>

    {{-- Scripts extras (equivalente ao block scripts_extra) --}}
    @stack('scripts_extra')

</body>
</html>
