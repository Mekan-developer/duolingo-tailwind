<div class="w-full">
    @props([
        "lessons","lessonId","locales","switch_lesson"
    ])
    <div class="w-full">
        @if($lessons != null && !$lessons->isEmpty())
            <label for="lesson" class="block mb-2 text-sm font-medium text-gray-900">Select an lesson</label>
            <select wire:model="selectedLesson" wire:change="selectedLessonHandle" id="lesson" name="lesson_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">                                
                @if($switch_lesson)
                    <option selected>Choose a lesson</option>
                @endif
                @foreach ($lessons as $lesson)
                    <option value="{{$lesson->id}}" @if($lesson->id == $lessonId) selected @endif>
                        {{ $lesson->getTranslation('title',$locales[0]['locale']) }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('lesson_id')" class="mt-2" />
        @endif
    </div>
</div>