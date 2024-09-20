<!DOCTYPE html>
<html lang="en">
    <x-admin.header title="duolingo" />
<body>
    <div class="flex w-full h-full">
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

