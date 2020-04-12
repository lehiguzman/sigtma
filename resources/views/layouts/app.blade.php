<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sigtma') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.backstretch.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {                
            $(".fondos").backstretch([
                { url: '{{ url('/') }}/img/fondo/fondo1.jpg' },
                { url: '{{ url('/') }}/img/fondo/fondo2.jpg' },
                { url: '{{ url('/') }}/img/fondo/fondo3.jpg' },
                { url: '{{ url('/') }}/img/fondo/fondo4.jpg' }
                ], {                    
                    fade: 1500,
                    duration: 3000
                });
        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
</head>
<body class="fondos">
    <div>        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
