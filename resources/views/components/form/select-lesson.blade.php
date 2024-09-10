<div>
    @props([
        "lessons","locales"
    ])
    
    @if($lessons != null && !$this->lessons->isEmpty())
        <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an lesson</label>
        <select id="chapters" name="lesson_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option selected>Choose a lesson</option>
            @foreach ($lessons as $lesson)
                <option value="{{$lesson->id}}">{{ $lesson->name }}</option>
                {{-- <option value="{{$lesson->id}}">{{ $lesson->getTranslation('title',$locales[0]['locale']) }}</option> --}}
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('lesson_id')" class="mt-2" />
    @endif
</div>