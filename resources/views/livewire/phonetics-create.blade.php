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
                <div class="my-2">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="grid grid-cols-2 gap-4 my-2 " wire:ignore>
                            @include('includes.exerciseParts.create.english_text',['name'=>'example'.($i+1),'title' => 'examples','placeholder' => 'english character'])
                            @include('includes.exerciseParts.create.phonetics_sound',['name' => 'sound'.($i+1),'label' => 'label'.($i+1) ,'message' => 'message'.($i+1)])                            
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



