<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Site Title -->
    <title>Novecology</title>

    @yield('meta_data')

    <!-- Favicon Link -->
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">

    <!-- All CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/plugins/slick-slider/css/slick.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}"> --}}
    @yield('plugin-css')
    @include('includes.style_css')
    @yield('css')
    <script defer>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '410422680847226');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"src="https://www.facebook.com/tr?id=410422680847226&ev=PageView&noscript=1"/></noscript>
</head>





