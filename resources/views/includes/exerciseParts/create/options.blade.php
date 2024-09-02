<div class="flex flex-row w-full gap-6 mb-4">
    <div class="w-full">
        <label  class="block mb-2 text-sm font-medium @isset($textColor) {{$textColor}} @endisset" for="mySelect">Select an chapter</label>
        <select wire:model="selectedChapter" wire:change="selectedChapterHandle" id="mySelect" name="chapter_id" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            <option selected>Choose a chapter</option>
            @foreach ($chapters as $chapter)
                <option class="" value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('chapter_id')" class="mt-2" />
    </div>
    <div class="w-full">
        @if($lessons != null && !$this->lessons->isEmpty())
            <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900">Select an lesson</label>
            <select wire:model="selectedLesson" wire:change="selectedLessonHandle" id="chapters" name="lesson_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Choose a lesson</option>
                @foreach ($lessons as $lesson)
                    <option value="{{$lesson->id}}">{{ $lesson->getTranslation('title',$locales[0]['locale']) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('lesson_id')" class="mt-2" />
        @endif
    </div>
    <div class="w-full">
        @if($exercises != null && !$this->exercises->isEmpty())
            <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900">Select an exercise</label>
            <select id="chapters" name="exercise_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Choose a exercise</option>
                @foreach ($exercises as $exercises)
                    <option value="{{$exercises->id}}">{{ $exercises->getTranslation('title',$locales[0]['locale']) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('exercise_id')" class="mt-2" />
        @endif
    </div>
</div>