<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layout.partials.head')
    </head>
    <body>
      @include('layout.partials.navbar')
        @yield('generalWrapper')
      @include('layout.partials.footer-scripts')
    </body>
</html>
