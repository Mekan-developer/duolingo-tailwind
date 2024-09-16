<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add audio image for testing
        </div>

        <form action="{{route('phonetics.update',['phonetics' => $phonetics->id])}}" onsubmit="return validateForm()" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method('PATCH')
            <div class="flex flex-col gap-4 px-4 py-6 bg-gray-400 rounded-sm">
                <p class="text-white">PHONETICS PART ONE</p>
                <div class="flex flex-row w-full gap-6 mb-4">
                    <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales" textColor="text-white"/>
                    <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson" textColor="text-white" />
                    <x-form.edit.exercises-option :exercises="$exercises" :exerciseId="$exercise_id" :locales="$locales" :switch_exercise="$switch_exercise" textColor="text-white" />
                </div>
                <x-form.edit-input name="phonetic_alphabet" :value="$phonetics->phonetic_alphabet" labelText="English word" :errorMessage="$errors->get('phonetic_alphabet')" textColor="text-white" />
                <div class="grid grid-cols-2 gap-4" wire:ignore>
                    @foreach ($locales as $locale)
                    <textarea class="letter" id="HTML[{{$locale->locale}}]" name="phonetic_text[{{$locale->locale}}]" placeholder="phonetics {{$locale->name}} description">
                        {!! $phonetics->translate('phonetic_text',$locale->locale) !!}
                    </textarea>
                    @endforeach
                </div>
                <div>
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            </div>
            <div class="px-4 py-6 mt-10 bg-white rounded-sm">
                <p class="text-black">PHONETICS PART TWO</p>
                <div id="test" class="my-2">   
                    @for($i = 1; $i <= 5; $i++)
                        <div class="grid grid-cols-2 gap-4 my-4">
                            <div class="flex flex-col">
                                @include('includes.exerciseParts.edit.english_text',['name'=>'examples['.$i.']','title' => 'examples','placeholder' => 'english character','value' => $phonetics->translate('examples',$i)])
                            </div>
                            <div class="flex flex-row items-end ">
                                @include('includes.exerciseParts.create.phonetics_sound',['name' => 'sound'.$i,'title' => 'upload sound '.$i,'uniqueId' => $i])
                            </div>                                                    
                        </div>
                        <div class="grid grid-cols-2 gap-4 -mt-4">
                            <div class="flex-1">
                                @error('examples.'.$i)
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex-1">
                                @error('sound'.$i)
                                    <span class="text-xs text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                  
                    @endfor
                </div>
                <x-form.order :request="$phoneticss" :currentOrder="$phonetics"></x-form.order>
                <div class="flex w-full gap-4">
                    <x-form.btn-submit name="update" class="flex-1"/>
                </div>
            </div>
        </form>
    </div> 
</div>
