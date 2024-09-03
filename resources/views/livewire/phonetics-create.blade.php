<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add audio image for testing
        </div>

        <form action="{{route('phonetics.store')}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            <div class="flex flex-col gap-4 px-4 py-6 bg-gray-400 rounded-sm">
                <p class="text-white">PHONETICS PART ONE</p>
                @include('includes.exerciseParts.create.options',['textColor'=> 'text-white'])

                <div class="mb-4" wire:ignore>
                    @include('includes.exerciseParts.create.english_text',['name'=>'phonetic_alphabet','title' => 'English character','placeholder' => 'english character','textColor' => 'text-white'])
                </div>
                <div class="grid grid-cols-2 gap-4" wire:ignore>
                    @foreach ($locales as $locale)
                        <textarea class="letter" id="HTML[{{$locale->locale}}]" name="phonetic_text[{{$locale->locale}}]" placeholder="phonetics {{$locale->name}} description"></textarea>
                    @endforeach
                </div>
            </div>
            <div class="bg-white px-4 py-6 rounded-sm mt-10">
                <p class="text-black">PHONETICS PART TWO</p>
                <div id="test" class="my-2">
                    @for($i = 1; $i <= $countExamples; $i++)
                        <div class="grid grid-cols-2 gap-4 my-2 " wire:ignore>
                            @include('includes.exerciseParts.create.english_text',['name'=>'examples['.$i.']','title' => 'examples','placeholder' => 'english character'])
                            <div class="flex flex-row items-center m-0 p-0">
                                <div class="flex-1 pt-1">
                                    @include('includes.exerciseParts.create.phonetics_sound',['name' => 'sounds['.$i.']', 'uniqueId' => $i])
                                </div>
                                @if($i==1)                           
                                    <a wire:click.prevent="addExamples" class=" cursor-pointer text-white text-center leading-[42px] bg-[var(--bg-color-active)] h-[42px] aspect-square ml-1 focus:ring-4 font-medium rounded-sm me-2 ">+</a>
                                @else 
                                    <a wire:click.prevent="removeExamples" class=" cursor-pointer text-white text-center leading-[42px] bg-[var(--bg-color-active)] h-[42px] aspect-square ml-1 focus:ring-4 font-medium rounded-sm me-2 ">-</a>
                                @endif   
                            </div>                                                    
                        </div>
                    @endfor
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



