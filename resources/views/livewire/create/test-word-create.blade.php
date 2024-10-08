<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add test words with audio 
        </div>

        <form action="{{route('testWord.store')}}" method="post" enctype="multipart/form-data"  
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            <div class="px-4 py-6 bg-white rounded-sm">
                @include('includes.exerciseParts.create.options')
                @foreach ($locales as $locale)
                    <x-form.input :name="'translations_word['.$locale->locale.']'" :getOldName="'translations_word.' . $locale->locale " :placeholder="'Translate '. $locale->locale" :labelText="'Translate '. $locale->name" :errorMessage="$errors->get('translations_word.' . $locale->locale)" />
                @endforeach
               
                <div class="mt-2">
                    @include('includes.exerciseParts.create.sound_file')
                </div>
                
            </div>
        
            <div class="my-4 flex gap-4">
                @include('includes.exerciseParts.create.english_text',['name'=>'en_correct_text', 'oldName' => 'en_correct_text','title' => 'English correct text','placeholder' => 'english correct word']) 
                @include('includes.exerciseParts.create.english_text',['name'=>'en_incorrect_text', 'oldName' => 'en_incorrect_text','title' => 'English incorrect text','placeholder' => 'english incorrect word']) 
            </div>
            <x-form.btn-submit/>
        </form>
    </div>    
</div>
