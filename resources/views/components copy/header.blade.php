<div>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Duolingo</title>

    <!-- Fonts -->
    {{ $slot }}
    @vite('resources/css/app.css')
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
</div>