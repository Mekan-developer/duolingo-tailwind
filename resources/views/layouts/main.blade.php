<!DOCTYPE html>
<html lang="en">
    <x-admin.header title="duolingo">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <x-slot name="style"> </x-slot>
    </x-admin.header>
<body>
    <div class="flex w-full">
        <div>
            @include("includes.sidebar")
        </div>
        <div class="flex-1 bg-gray-200 w-full  p-4 h-[100vh] overflow-hidden overflow-y-auto">
            @yield("content")
        </div>
    </div>

    @livewireScripts
</body>
</html>

