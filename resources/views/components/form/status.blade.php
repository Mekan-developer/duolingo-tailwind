@props([
    'route',
    'modelName',
    'id',
    'currentStatus'
])


<div>
    <form action="{{ route($route, [$modelName => $id])}}" 
        method= "post">
        @csrf
        @method('PUT')
        <label class="relative inline-flex items-center cursor -pointer">
            <input type="checkbox" name="status" @if($currentStatus) checked @endif class="sr-only peer">
            <div class="relative w-11 h-6 bg-red-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
            <button type="submit" class="w-[45px] h-[25px] absolute top-0"></button>{{-- image activate and disactivate button --}}
        </label>
    </form>
</div>