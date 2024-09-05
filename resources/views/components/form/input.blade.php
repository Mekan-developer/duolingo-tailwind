<div>
    @props([
        'name', 'placeholder', 'labelText', 'errorMessage'
    ])
    <div class="mb-5">
        <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $labelText }}</label>
        <input type="text" name="{{ $name }}" placeholder="{{ $placeholder }}" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        <x-input-error :messages="$errorMessage" class="mt-2" />
    </div>
</div>
