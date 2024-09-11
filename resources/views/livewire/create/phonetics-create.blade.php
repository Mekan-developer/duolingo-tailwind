<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add audio image for testing
        </div>

        <form action="{{route('phonetics.store')}}" method="post" enctype="multipart/form-data"  
        lass="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
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
                <div>
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            </div>
            <div class="px-4 py-6 mt-10 bg-white rounded-sm">
                <p class="text-black">PHONETICS PART TWO</p>
                <div id="test" class="my-2">@php $loop=0 @endphp
                    @for($i = 1; $i <= $countExamples; $i++)
                        <div class="grid grid-cols-2 gap-4 my-4">
                            @include('includes.exerciseParts.create.english_text',['name'=>'examples['.$i.']','title' => 'examples','placeholder' => 'english character'])
                            <div class="flex flex-row items-end ">
                                <div class="flex-1 pt-1">
                                    <x-form.include.phonetics-sound :name="'sounds['.$i.']'"  :uniqueId="$i" />
                                </div>
                                <div class="flex ">
                                    @if($i==1)                           
                                        <a wire:click.prevent="addExamples" class=" cursor-pointer text-white text-center leading-[42px] bg-[var(--bg-color-active)] h-[42px] aspect-square ml-1 focus:ring-4 font-medium rounded-sm me-2 ">+</a>
                                    @else 
                                        <a wire:click.prevent="removeExamples" class=" cursor-pointer text-white text-center leading-[42px] bg-[var(--bg-color-active)] h-[42px] aspect-square ml-1 focus:ring-4 font-medium rounded-sm me-2 ">-</a>
                                    @endif 
                                </div>  
                            </div>                                                    
                        </div>
                    @endfor
                </div>
                <x-form.btn-submit/>
            </div>
        </form>
    </div> 
</div>



