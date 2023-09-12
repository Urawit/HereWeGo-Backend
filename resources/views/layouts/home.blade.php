<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HERE WE GO</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  
        <!-- Compiled CSS -->
        @vite('resources/css/app.css')

        <!-- Scripts -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    
    <body class="bg-[#F2F2F2]">
        <div>
            @include('navbar/navbar')
            @include('header')
        </div>
        <div id="content">
            @include('content')
        </div>
        <footer class="">
            @include('footer')
        </footer>
    </body>
</html>
