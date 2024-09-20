<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit grammar theory and practics 
        </div>
        <form action="{{route('grammar.update',['grammar' => $grammar->id])}}" method="post" enctype="multipart/form-data"  
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf 
            @method('patch')
            <div class="flex flex-col gap-4 px-4 py-6 bg-gray-400 rounded-sm">
                <p class="text-white">THEORY PART</p>
                <div class="flex flex-row w-full gap-6 mb-4">
                    <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales" textColor="text-white"/>
                    <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson" textColor="text-white" />
                </div>
                <div class="grid grid-cols-2 gap-4" wire:ignore>
                    @foreach ($locales as $locale)
                        <div class="flex flex-col mt-1">
                            <textarea class="letter" id="grammar[{{$locale->locale}}]"  name="grammar_theory[{{$locale->locale}}]" placeholder="Theory {{$locale->name}} description">
                                {{ $grammar->translate("grammar_theory",$locale->locale) }}
                            </textarea>
                            @error("grammar_theory.".$locale->locale)
                                <span class="text-xs text-red-600">{{ $locale->name }} text field is required</span>
                            @enderror
                        </div>   
                    @endforeach
                </div>
            </div>
            <div class="px-4 py-6 mt-10 bg-white rounded-sm">
                <p class="text-black">PRACTICS PART</p>
                <div class="my-2">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($locales as $locale)
                            <div class="flex flex-col w-full">
                                <textarea name="text[{{$locale->locale}}]" class="font-normal" cols="30" rows="4" placeholder="Text {{$locale->name}}">{{ $grammar->translate("text",$locale->locale) }}</textarea>
                                @error("text.".$locale->locale)
                                    <span class="text-xs text-red-600">{{ $locale->name }} text field is required</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                    @foreach ($text_correct_parts as $key => $value)
                        <div class="grid grid-cols-2 gap-4 my-2 " wire:ignore>
                            <div class="flex flex-col w-full mb-2">
                                {{-- @include('includes.exerciseParts.create.english_text',['name'=>'text_correct_parts[' . $i . ']','title' => 'text correct part '.($i),'placeholder' => 'text correct parts '.$i]) --}}
                                @include('includes.exerciseParts.edit.english_text',['name'=>'text_correct_parts['.$loop->iteration.']','title' => 'text_correct_parts','placeholder' => 'Text correct parts','value' => $value])
                                @error("text_correct_parts.".$loop->iteration)
                                    <span class="-mt-4 text-xs text-red-600">text for correct words field is required</span>
                                @enderror
                            </div>
                            <div class="flex flex-row items-end mb-2 ">
                                <div class="flex flex-col flex-1">
                                    @include('includes.exerciseParts.edit.english_text',['name'=>'text_incorrect_parts['.$loop->iteration.']','title' => 'text_incorrect_parts','placeholder' => 'Text incorrect parts','value' => $text_incorrect_parts[$key]])
                                    
                                    @error("text_incorrect_parts.".$loop->iteration)
                                        <span class="-mt-4 text-xs text-red-600">text for incorrect words field is required</span>
                                    @enderror
                                </div>  
                                <div class="flex flex-col justify-end cursor-pointer">
                                    @if($loop->iteration==1)                           
                                        <a wire:click.prevent="addTextField" class="transform active:scale-95 text-white bg-[var(--bg-color-active)] ml-1 h-[42px] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 ">+</a>
                                    @else 
                                        <a @if($maxTextCorrectPartsKey > 1) wire:click="removeFieldCount" wire:click.prevent="removeTextField({{$key}})" @endif  class="transform active:scale-95 text-white bg-[var(--bg-color-active)] ml-1 h-[42px] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 ">-</a>
                                    @endif
                                </div>                          
                                
                            </div>                            
                        </div> 
                        <input type="number" value="{{ $removeInputNumber }}"  name="removeInputNumber" hidden>
                    @endforeach
                    @include('includes.exerciseParts.create.sound_file',['name' => 'audio','label' => 'label' ,'message' => 'message'])
                </div>
                {{-- hint (podskazka) for grammar practics --}}
                <div class="w-full flex justify-end my-2">   
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:change='toggle' name='hintChecker' class="sr-only peer fixed" @if($showDiv) checked @endif>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-md font-medium text-gray-900 dark:text-gray-300">hint</span>
                    </label>
                </div>

                @if($showDiv)
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        @foreach ($locales as $locale)
                        <div class="flex flex-col w-full">
                            <textarea name="hint[{{$locale->locale}}]" class="font-normal" cols="30" rows="4" placeholder="Hint {{$locale->name}}">{{ $grammar->translate("hint",$locale->locale) }}</textarea>
                            @error("hint.".$locale->locale)
                                <span class="text-xs text-red-600">{{ $locale->name }} hint is required</span>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                @endif
                {{-- end hint --}}
                <x-form.order :request="$grammars" :currentOrder="$grammar"></x-form.order>
                <x-form.btn-submit name="update" />
            </div>
        </form>
    </div> 
</div>



