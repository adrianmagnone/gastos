<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
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
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('favicon.ico') }}" />
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
  </body>
</html>    