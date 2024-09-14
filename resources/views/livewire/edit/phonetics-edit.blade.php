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
                    @foreach ($phoneticsExamples->examples as $key => $example)
                        <div class="grid grid-cols-2 gap-4 my-4">
                            @include('includes.exerciseParts.edit.english_text',['name'=>'examples['.$loop->iteration.']','title' => 'examples','placeholder' => 'english character','value' => $example])
                            <div class="flex flex-row items-end ">
                                <div class="flex-1 ">
                                    <x-form.include.phonetics-sound :name="'sounds['.$loop->iteration.']'"  :uniqueId="$loop->iteration" />
                                    <input type="number"  value="{{$removeSoundNumber}}"  name="removeSoundNumber" hidden>
                                </div>
                                <div class="flex ">
                                    @if($loop->iteration==1)                           
                                        <a wire:click.prevent="addExamples" onclick="fileChoosenOrNo(456)" class="cursor-pointer text-white text-center leading-[42px] bg-[var(--bg-color-active)] h-[42px] aspect-square ml-1 focus:ring-4 font-medium rounded-sm">+</a>
                                    @else 
                                        <a @if($maxSoundKey <= $key) wire:click.prevent="removeExamples({{$key}})" wire:click="removeSoundCount" @endif class=" cursor-pointer text-white text-center leading-[42px] bg-[var(--bg-color-active)] h-[42px] aspect-square ml-1 focus:ring-4 font-medium rounded-sm">-</a>
                                    @endif  
                                </div>
                            </div>                                                    
                        </div>

                    @endforeach
                </div>
                <x-form.order :request="$phoneticss" :currentOrder="$phonetics"></x-form.order>
                <div class="flex w-full gap-4">
                    <x-form.btn-submit name="update" class="flex-1"/>
                </div>
            </div>
        </form>
    </div> 
</div>
