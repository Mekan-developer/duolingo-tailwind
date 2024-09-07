<div class="w-full">
    @props([
        "chapters","locales","textColor"
    ])
    <div class="w-full">
        <label  class="block mb-2 text-sm font-medium @isset($textColor) {{$textColor}} @endisset" for="mySelect">Select an chapter</label>
        <select wire:model="selectedChapter" wire:change="selectedChapterHandle" id="mySelect" name="chapter_id" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @foreach ($chapters as $chapter)
                <option value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('chapter_id')" class="mt-2" />
    </div>
</div>