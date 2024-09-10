<div>
    <div class="p-6 bg-white">
        <div class="p-4 ml-6 text-[var(--bg-color-active)] font-bold text-[22px]">
            Create Information
        </div>
        <form action="{{route('information.store')}}" method="POST" onsubmit="disableButton()">
            @csrf
            @method("POST")
            <div class="container flex flex-col gap-10 p-4 mx-auto bg-gray-200">
                <div class="flex w-full gap-10">
                    <div class="flex-1">
                        <span class="text-[var(--bg-color-active)] my-1 py-2">Lessons</span>
                        @include('includes.information-includes.lesson-checkbox',['lessons' => $lessons])
                        @error('lesson_ids')
                            <span class="text-xs text-red-600">Choose lessons</span>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <span class="text-[var(--bg-color-active)] my-1 py-2">Exercise</span>
                        @include('includes.information-includes.exercise-checkbox',['exercises' => $exercises])
                        @error('exercise_ids')
                            <span class="text-xs text-red-600">Choose exercise</span>
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
                        <span class="text-xs text-red-600">Insert text</span>
                    @enderror
                </div>
                <x-form.btn-submit />
            </div>
        </form>
    </div>
</div>