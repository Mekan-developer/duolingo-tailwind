<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add grammar theory and practics
        </div>

        <form action="{{route('grammar.store')}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            
            <div class="flex flex-col gap-4 px-4 py-6 bg-gray-400 rounded-sm">
                <p class="text-white">THEORY PART</p>
                @include('includes.exerciseParts.create.options',['textColor'=> 'text-white'])
                <div class="grid grid-cols-2 gap-4" wire:ignore>
                    @foreach ($locales as $locale)
                        <textarea class="letter" id="grammar[{{$locale->locale}}]" name="grammar_theory[{{$locale->locale}}]" placeholder="Theory {{$locale->name}} description"></textarea>
                    @endforeach
                </div>
            </div>
            <div class="bg-white px-4 py-6 rounded-sm mt-10">
                <p class="text-black">PRACTICS</p>
                <div class="my-2">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($locales as $locale)
                            <textarea name="text[{{$locale->locale}}]" cols="30" rows="4" placeholder="Text {{$locale->name}}"></textarea>
                        @endforeach
                    </div>
                    <div class="flex flex-row-reverse">
                        
                    </div>
                    @for ($i = 1; $i <= $countWordParts; $i++)
                        <div class="grid grid-cols-2 gap-4 my-2 " wire:ignore>
                            @include('includes.exerciseParts.create.english_text',['name'=>'text_correct_parts[' . $i . ']','title' => 'text correct part '.($i),'placeholder' => 'text parts'])
                            <div class="flex items-end">
                                <div class="flex-1">
                                    @include('includes.exerciseParts.create.english_text',['name' => 'text_incorrect_parts[' . $i . ']','title' => 'text incorrect part '.($i),'placeholder' => 'text parts'])   
                                </div>                               
                                @if($i==1)                           
                                    <a href="{{route('grammar.create')}}" wire:click.prevent="addTextField" class="text-white bg-[var(--bg-color-active)] h-[42px] mb-4 ml-1 focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 ">+</a>
                                @else 
                                    <a href="{{route('grammar.create')}}" wire:click.prevent="removeTextField" class="text-white bg-[var(--bg-color-active)] h-[42px] mb-4 ml-1 focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 ">-</a>
                                @endif
                            </div>                            
                            
                        </div>
                    @endfor
                    @include('includes.exerciseParts.create.sound_file',['name' => 'audio','label' => 'label' ,'message' => 'message'])
                </div>
                <button type="submit" class="w-full py-4 bg-[var(--bg-color-active)] rounded-md text-white text-[18px] mt-4"> save </button>
            </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif
    </div> 
</div>



