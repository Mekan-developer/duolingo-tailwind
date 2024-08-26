<!DOCTYPE html>
<html lang="en">
    <x-admin.header title="duolingo">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <x-slot name="style">
            <style>
                *{
                    font-family: "Roboto", sans-serif;
                    font-weight: 400;
                    font-style: normal;
                }
            </style>
        </x-slot>
    </x-admin.header>
<body>
    <div class="flex w-full">
        <div>
            @include("includes.sidebar")
        </div>
        <div class="w-full container p-4">
            @yield("content")
        </div>
    </div>
</body>
</html>

