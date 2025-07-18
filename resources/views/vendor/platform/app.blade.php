<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}" data-controller="html-load" dir="{{ \Orchid\Support\Locale::currentDir() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <title>
        @yield('title', config('app.name'))
        @hasSection('title')
            - {{ config('app.name') }}
        @endif
    </title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}" />
    <meta name="csrf_token" content="{{ csrf_token() }}" id="csrf_token">
    <meta name="auth" content="{{ Auth::check() }}" id="auth">
    @if(\Orchid\Support\Locale::isRtl())
        <link rel="stylesheet" type="text/css" href="{{  mix('/css/orchid.rtl.css','vendor/orchid') }}"  data-turbo-track="reload" >
    @else
        <link rel="stylesheet" type="text/css" href="{{  mix('/css/orchid.css','vendor/orchid') }}"  data-turbo-track="reload" >
    @endif

    @stack('head')

    <meta name="view-transition" content="same-origin">
    <meta name="turbo-root" content="{{  Dashboard::prefix() }}">
    <meta name="turbo-refresh-method" content="{{ config('platform.turbo.refresh-method', 'replace') }}">
    <meta name="turbo-refresh-scroll" content="{{ config('platform.turbo.refresh-scroll', 'reset') }}">
    <meta name="turbo-prefetch" content="{{ var_export(config('platform.turbo.prefetch', true)) }}">
    <meta name="dashboard-prefix" content="{{  Dashboard::prefix() }}">

    @if(!config('platform.turbo.cache', false))
        <meta name="turbo-cache-control" content="no-cache">
    @endif

    @foreach(collect(['/js/manifest.js', '/js/vendor.js', '/js/orchid.js']) as $key)
        <script src="{{ mix($key,'vendor/orchid') }}" data-turbo-track="reload" type="text/javascript"></script>
    @endforeach

    @foreach(Dashboard::getResource('stylesheets') as $stylesheet)
        <link rel="stylesheet" href="{{  $stylesheet }}" data-turbo-track="reload">
    @endforeach

    @stack('stylesheets')

    @foreach(Dashboard::getResource('scripts') as $scripts)
        <script src="{{  $scripts }}" defer type="text/javascript" data-turbo-track="reload"></script>
    @endforeach

    @if(!empty(config('platform.vite', [])))
        @vite(config('platform.vite'))
    @endif
    <link href="{{ asset('css/orchid-custom.css') }}" rel="stylesheet">

</head>

<body class="{{ \Orchid\Support\Names::getPageNameClass() }}" data-controller="pull-to-refresh">

<div class="container-fluid" data-controller="@yield('controller')" @yield('controller-data')>

    <div class="row justify-content-center d-md-flex h-100">
        @yield('aside')

        <div class="col-xxl col-xl-9 col-12 mx-auto">
            @yield('body')
        </div>
    </div>


    @include('platform::partials.toast')
</div>

@stack('scripts')

@include('platform::partials.search-modal')
</body>
</html>
