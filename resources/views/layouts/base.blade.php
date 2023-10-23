<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta16
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
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
  
  <body @hasSection('BodyClass') class="@yield('BodyClass')" @endif>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="{{ url('img/logo_barra.png') }}" width="110" height="32" alt="Logo Mutual" class="navbar-brand-image">
            </a>
          </h1>
          <x-topbar />
          
          @if (Auth::check())
            <x-menubar />
          @endif
        </div>
      </header>
      <div class="page-wrapper">
          @yield('BaseBody')
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
    @endif
  </body>
</html>