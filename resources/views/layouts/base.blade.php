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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        --tblr-font-monospace:  "Source Code Pro", monospace;
        --tblr-body-font-size: 0.75rem;
      }
    </style>

    <!-- Libs CSS - JS  -->
    @yield('Bundles')
  </head>
  
  <body class="layout-fluid @hasSection('BodyClass') @yield('BodyClass') @endif">
    <div class="page">
      <!-- Navbar -->
      <x-menubar />
      {{-- <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <x-topbar />
        </div>
      </header> --}}
      <div class="page-wrapper">
          @yield('BaseBody')
          @include('layouts.footer')
      </div>
    </div>
  
    <!-- Handler for local scripts -->
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', function() {
            Main.init({
              'login': 1,
              'base_url': "{{ url('/') }}",
              'tipo_usuario': 1
            });       

        });
    </script>
    @hasSection('PageJs')
        @yield('PageJs') 
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', function() {
                Main.evitarEnterEnvieForm();
                init(jQuery);
            });
        </script>
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
    @endif
  </body>
</html>