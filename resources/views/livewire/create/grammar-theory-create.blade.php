<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add grammar theory and practics 
        </div>

        <form action="{{route('grammar.store')}}" method="post" enctype="multipart/form-data"  
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf 
            <div class="flex flex-col gap-4 px-4 py-6 bg-gray-400  rounded-sm">
                <p class="text-white">THEORY PART</p>
                @include('includes.exerciseParts.create.options',['textColor'=> 'text-white'])
                <div class="grid grid-cols-2 gap-4" wire:ignore>
                    @foreach ($locales as $locale)
                        <div class="flex flex-col mt-1">
                            <textarea class="letter" id="grammar[{{$locale->locale}}]" name="grammar_theory[{{$locale->locale}}]" placeholder="Theory {{$locale->name}} description"></textarea>
                            @error("grammar_theory.".$locale->locale)
                                <span class="text-xs text-red-600">{{ $locale->name }} text field is required</span>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="px-4 py-6 mt-10 bg-white rounded-sm">
                <p class="text-black">PRACTICS</p>
                <div class="my-2">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($locales as $locale)
                            <div class="flex flex-col w-full">
                                <textarea name="text[{{$locale->locale}}]" class="font-normal rounded-md bg-gray-50" cols="30" rows="4" placeholder="Text {{$locale->name}}">{{ old('text.' . $locale->locale) }}</textarea>
                                @error("text.".$locale->locale)
                                    <span class="text-xs text-red-600">{{ $locale->name }} text field is required</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>


                    <div class="grid grid-cols-2 gap-4 mb-4" wire:ignore>
                        @foreach ($locales as $locale)
                            <div class="flex flex-col w-full">
                                <label class="font-normal" >Hint for {{$locale->name}}</label>
                                <textarea name="hint[{{$locale->locale}}]" cols="30" class="letter font-normal rounded-md bg-gray-50" rows="4" placeholder="Hint {{$locale->name}}">{{ old('hint.' . $locale->locale) }}</textarea>
                                @error("hint.".$locale->locale)
                                    <span class="text-xs text-red-600">{{ $locale->name }} hint field is required</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>


                    @for ($i = 1; $i <= $countWordParts; $i++)
                        <div class="grid grid-cols-2 gap-4 my-2 " wire:ignore>
                            <div class="flex flex-col w-full mb-2">
                                @include('includes.exerciseParts.create.english_text',['name'=>'text_correct_parts[' . $i . ']','oldName' => 'text_correct_parts.' . $i ,'title' => 'text correct part '.($i),'placeholder' => 'text correct parts '.$i])
                            </div>
                            
                            <div class="flex flex-row items-end mb-2 ">
                                <div class="flex flex-col flex-1">
                                        @include('includes.exerciseParts.create.english_text',['name' => 'text_incorrect_parts[' . $i . ']','oldName' => 'text_correct_parts.' . $i ,'title' => 'text incorrect part '.($i),'placeholder' => 'text incorrect parts '.$i])     
                                </div>  
                                <div class="flex flex-col justify-end">
                                    @if($i==1)                           
                                        <a wire:click.prevent="addTextField" class="transform active:scale-95 text-white bg-[var(--bg-color-active)] ml-1 h-[42px] font-medium rounded-sm px-4 py-2 me-2 ">+</a>
                                    @else 
                                        <a wire:click.prevent="removeTextField" class="transform active:scale-95 text-white bg-[var(--bg-color-active)] ml-1 h-[42px] font-medium rounded-sm px-4 py-2 me-2 ">-</a>
                                    @endif
                                </div>                          
                                
                            </div>                           
                        </div> 
                        <div class="grid grid-cols-2 gap-4 my-2 " wire:ignore>
                            <div>
                                @error("text_correct_parts.".$i)
                                    <span class="-mt-4 text-xs text-red-600">text for correct words field is required</span>
                                @enderror
                            </div>
                            <div>
                                @error("text_incorrect_parts.".$i)
                                    <span class="-mt-4 text-xs text-red-600">text for incorrect words field is required</span>
                                @enderror
                            </div>
                        </div> 
                    @endfor
                    @include('includes.exerciseParts.create.sound_file',['name' => 'audio','label' => 'label' ,'message' => 'message'])
                </div>
                {{-- <div wire:ignore> --}}
                    {{-- hint (podskazka) for grammar practics --}}
                    {{-- <div class="w-full flex justify-end my-2">   
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:change='toggle' name="hint" class="sr-only peer fixed" />
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ms-3 text-md font-medium text-gray-900 dark:text-gray-300">hint</span>
                        </label>
                    </div> --}}
                    {{-- {{dump(old('hint'))}} --}}
                    {{-- @if($showDiv)
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            @foreach ($locales as $locale)
                                <div class="flex flex-col w-full">
                                    <label class="font-normal" >Hint for {{$locale->name}}</label>
                                    <textarea name="hint[{{$locale->locale}}]" cols="30" class="letter font-normal rounded-md bg-gray-50" rows="4" placeholder="Hint {{$locale->name}}" required>{{ old('hint.' . $locale->locale) }}</textarea>
                                    @error("hint.".$locale->locale)
                                        <span class="text-xs text-red-600">{{ $locale->name }} text field is required</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    @endif --}}
                {{-- </div> --}}

                

                <x-form.btn-submit/>
            </div>
        </form>
    </div> 
</div>



