<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-header title="dualingo">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <x-slot name="style">
            <style>
                *{box-sizing: border-box;}
            </style>
        </x-slot>
    </x-header>
    <body class="font-sans antialiased">
        @yield('content')
    </body>
</html>
