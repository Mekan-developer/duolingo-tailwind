<div class="w-full">
    @props([
        "exercises","exerciseId","locales","switch_exercise"
    ])
    <div class="w-full">
        
        @if($exercises != null && !$exercises->isEmpty())
            <label for="exercise" class="block mb-2 text-sm font-medium text-gray-900">Select an exercise</label>
            <select id="exercise" name="exercise_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @if($switch_exercise)
                    <option selected>Choose a exercise</option>
                @endif
                @foreach ($exercises as $exercise)
                
                    <option @if($exercise->id == $exerciseId) selected @endif value="{{$exercise->id}}">{{ $exercise->getTranslation('title',$locales[0]['locale']) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('exercise_id')" class="mt-2" />
        @endif
    </div>
</div>