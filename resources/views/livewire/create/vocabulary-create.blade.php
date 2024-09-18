<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add vocabulary
        </div>

        <form action="{{route('vocabulary.store')}}" method="post" enctype="multipart/form-data" 
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            <div class="px-4 py-6 bg-white rounded-sm">
                @include('includes.exerciseParts.create.options') 
                @include('includes.exerciseParts.create.english_text',['name'=>'en_text','title' => 'English word','placeholder' => 'english word']) 

                <div class="flex flex-row w-full gap-10 mt-2">
                    @include('includes.exerciseParts.create.image_file')
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            </div>
            <div class="mt-4">
                @foreach ($locales as $locale)
                    <x-form.input :name="'translations_word['.$locale->locale.']'" :getOldName="'translations_word.' . $locale->locale" :placeholder="'Translate '. $locale->locale" :labelText="'Translate '. $locale->name" :errorMessage="$errors->first('translations_word.' . $locale->locale)" />
                @endforeach
                <x-form.btn-submit/>
            </div>
        </form>
    </div>    
</div>
