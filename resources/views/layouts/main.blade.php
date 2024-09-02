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
<body class="w-[100vw]">
    
    <div class="flex w-full">
        <div>
            @include("includes.sidebar")
        </div>
        <div class="flex-1 bg-gray-200 w-full  p-4 h-[100vh] overflow-hidden overflow-y-auto">
            @yield("content")
        </div>
    </div>


    @livewireScripts

    <script>
        tinymce.init({
            selector: 'textarea.letter',
            license_key: 'glpvuu4bgw2i0d17uizamjpfwjswu59kbeacaefftswsyuty',
            maxwidth: 600,
            maxHeight: 250
        });
    </script>
</body>
</html>

