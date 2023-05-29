<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{asset("plugins/fontawesome-free/css/all.min.css")}}">
        <link rel="stylesheet" href="{{asset("dist/css/adminlte.css")}}">

        <!-- jQuery -->
        <script src="{{asset("plugins/jquery/jquery.min.js")}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset("plugins/jquery-ui/jquery-ui.min.js")}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <!-- AdminLTE App -->
        <script src="{{asset("dist/js/adminlte.js")}}"></script>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
