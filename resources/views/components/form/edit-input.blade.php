<div class="flex-1">
    @props([
        'name','labelText', 'errorMessage','value',"textColor"
    ])
    <div class="mb-5">
        <label class="block text-sm font-medium @isset($textColor) {{$textColor}} @endisset dark:text-white" >{{ $labelText }}</label>
        <input type="text" name="{{ $name }}" value="{{ $value }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <x-input-error :messages="$errorMessage" class="mt-2" />
    </div>
</div>
