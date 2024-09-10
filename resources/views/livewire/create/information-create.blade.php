<div>
    <div class="p-6 bg-white">
        <div class="p-4 ml-6 text-[var(--bg-color-active)] font-bold text-[22px]">
            Create Information
        </div>
        <form action="{{route('information.store')}}" method="POST">
            @csrf
            @method("POST")
            <div class="container mx-auto flex flex-col gap-10 bg-gray-200 p-4">
                <div class="flex gap-10  w-full">
                    <div class="flex-1">
                        <span class="text-[var(--bg-color-active)] my-1 py-2">Lessons</span>
                        @include('includes.information-includes.lesson-checkbox',['lessons' => $lessons])
                        @error('lesson_ids')
                            <span class="text-red-600 text-xs">Choose lessons</span>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <span class="text-[var(--bg-color-active)] my-1 py-2">Exercise</span>
                        @include('includes.information-includes.exercise-checkbox',['exercises' => $exercises])
                        @error('exercise_ids')
                            <span class="text-red-600 text-xs">Choose exercise</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-2 gap-10" wire:ignore>
                        @foreach ($locales as $locale)
                            <div class="flex flex-col text-[var(--bg-color-active)] my-1 py-2">
                                <span>{{$locale->name}} Information</span>
                                <textarea  class="letter h-[300px]" id="HTML[{{$locale->locale}}]" name="information[{{ $locale->locale }}]"  placeholder="Informations {{$locale->name}}"></textarea>
                            </div>
                        @endforeach
                    </div>
                    @error('information[{{ $locale->locale }}]')
                        <span class="text-red-600 text-xs">Insert text</span>
                    @enderror
                </div>
                <button type="submit" class ='w-full py-4 bg-[var(--bg-color-active)] rounded-sm text-white text-[18px]'> save </button>
            </div>
        </form>
    </div>
</div>