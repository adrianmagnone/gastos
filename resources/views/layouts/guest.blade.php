<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.3.0
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">    
    <title>{{ config('app.name') }} | @yield('PageTittle')</title>
    <!-- CSS files -->
    <x-bundle src="jQuery|tabler" />
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
    </style>

    <!-- Libs CSS - JS  -->
    @yield('Bundles')
  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <img src="{{ url('img/logo_s.png') }}" width="203" height="50" alt="Logo Mutual">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    @yield('PageBody')
                </div>
            </div>
        </div>
    </div>

    <!-- Handler for local scripts -->
    @hasSection('PageJs')
        @yield('PageJs') 
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', function() {
                init(jQuery);
            });
        </script>
    @endif
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
              var themeConfig = {
                "theme": "light",
                "theme-base": "gray",
                "theme-font": "sans-serif",
                "theme-primary": "azure",
                "theme-radius": "1",
              };
            });
        </script>
  </body>
</html>    