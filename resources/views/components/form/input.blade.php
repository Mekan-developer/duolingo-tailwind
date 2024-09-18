<div class="flex-1">
    @props([
        'name', 'placeholder', 'labelText', 'errorMessage','getOldName'
    ])
    <div class="mb-5">
        <label class="block text-sm font-medium text-gray-900 dark:text-white">{{ $labelText }}</label>
        <input type="text" name="{{ $name }}" placeholder="{{ $placeholder }}" @if(isset($getOldName)) value="{{old($getOldName)}}" @endif class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <x-input-error :messages="$errorMessage" class="mt-2" />
    </div>
</div>
