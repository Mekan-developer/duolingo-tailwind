<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add test words with audio
        </div>

        <form action="{{route('testWord.store')}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            <div class="bg-white px-4 py-6 rounded-sm">
                @include('includes.exerciseParts.create.options')
                @include('includes.exerciseParts.create.english_text',['name'=>'en_text','title' => 'English word','placeholder' => 'english word']) 
                @include('includes.exerciseParts.create.sound_file')
            </div>
        
            <div class="mt-2">
                @foreach ($locales as $locale)
                    <x-form.input :name="'translations_word['.$locale->locale.']'" :placeholder="'Translate '. $locale->locale" :labelText="'Translate '. $locale->name" :errorMessage="$errors->get('translations_word.' . $locale->locale)" />
                @endforeach
                <x-form.btn-submit/>
            </div>
        </form>
    </div>    
</div>
