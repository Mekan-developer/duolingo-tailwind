<div>
    @props([
        "chapters","locales"
    ])

    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an chapter</label>
    <select wire:model="selectedOption" wire:change="handleOptionChange" id="mySelect" name="chapter_id" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
        <option selected>Choose a chapter</option>
        @foreach ($chapters as $chapter)
            <option value="{{$chapter->id}}">{{ $chapter->name }}</option>
            {{-- <option value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option> --}}
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('chapter_id')" class="mt-2" />
</div>