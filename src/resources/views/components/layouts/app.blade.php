<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Bookings' }}</title>
        @livewireStyles
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
        <style>
        .container{
            display: flex;
            flex-direction: column;
            min-height: 100%;
            padding-block: 10px;
        }
        .content {
            flex: 1;
        }
    </style>
    </head>
    <body class="body" style="min-width: 80%; height: 100vh; margin-top:0;" >
        {{ $slot }}
        @livewireScripts
    </body>
    
</html>
