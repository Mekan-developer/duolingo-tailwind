<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add grammar theory and practics
        </div>

        <form action="{{route('grammar.store')}}" method="post" enctype="multipart/form-data"  
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf 
            <div class="flex flex-col gap-4 px-4 py-6 bg-gray-400 rounded-sm">
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
                                <textarea name="text[{{$locale->locale}}]" cols="30" rows="4" placeholder="Text {{$locale->name}}"></textarea>
                                @error("text.".$locale->locale)
                                    <span class="text-xs text-red-600">{{ $locale->name }} text field is required</span>
                                @enderror
                            </div>
                        @endforeach
                       
                    </div>
                    @for ($i = 1; $i <= $countWordParts; $i++)
                        <div class="grid grid-cols-2 gap-4 my-2 " wire:ignore>
                            <div class="flex flex-col w-full mb-2">
                                @include('includes.exerciseParts.create.english_text',['name'=>'text_correct_parts[' . $i . ']','title' => 'text correct part '.($i),'placeholder' => 'text correct parts '.$i])
                            </div>
                            
                            <div class="flex flex-row items-end mb-2 ">
                                <div class="flex flex-col flex-1">
                                        @include('includes.exerciseParts.create.english_text',['name' => 'text_incorrect_parts[' . $i . ']','title' => 'text incorrect part '.($i),'placeholder' => 'text incorrect parts '.$i])     
                                </div>  
                                <div class="flex flex-col justify-end">
                                    @if($i==1)                           
                                        <a href="{{route('grammar.create')}}" wire:click.prevent="addTextField" class="text-white bg-[var(--bg-color-active)] ml-1 h-[42px] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 ">+</a>
                                    @else 
                                        <a href="{{route('grammar.create')}}" wire:click.prevent="removeTextField" class="text-white bg-[var(--bg-color-active)] ml-1 h-[42px] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 ">-</a>
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
                <x-form.btn-submit/>
            </div>
        </form>
    </div> 
</div>



