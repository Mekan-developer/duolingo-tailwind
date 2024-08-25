<div>
    @props(['title'])
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', $title) }}</title>
        <!-- Fonts -->
            {{$slot}}
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        @isset($style)
                {{ $style }}
        @endisset
        <style>
            :root {
                --bg-color-active: #57BE99;
                --text-color-active: #4a5568;
                --bg-color-non-active: #F0F0F0;
                --text-color-non-active: #929292;
                /* --primary-color: #3490dc;
                --secondary-color: #ffed4a; */
            }
        </style>

    </head>    
</div>