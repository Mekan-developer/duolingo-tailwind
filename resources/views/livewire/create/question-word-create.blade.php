<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add question word 
        </div>

        <form action="{{route('questionWord.store')}}" method="post" enctype="multipart/form-data" 
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            <div class="px-4 py-6 bg-white rounded-sm">
                @include('includes.exerciseParts.create.options')

                @include('includes.exerciseParts.create.english_text',['name'=>'en_text','title' => 'English word','placeholder' => 'english word']) 
                @include('includes.exerciseParts.create.sound_file')
            </div>
            <div class="mt-2">
                @foreach ($locales as $locale)
                    <div class="flex flex-row gap-6 w-full">
                        <x-form.input :name="'translation_correct_words['.$locale->locale.']'" :placeholder="'Translate '. $locale->locale" :labelText="'Correct '. $locale->name" :errorMessage="$errors->get('translation_correct_words.' . $locale->locale)" :getOldName="'translation_correct_words.' . $locale->locale" />
                        <x-form.input :name="'translation_incorrect_words['.$locale->locale.']'" :placeholder="'Translate '. $locale->locale" :labelText="'Incorrect '. $locale->name" :errorMessage="$errors->get('translation_incorrect_words.' . $locale->locale)" :getOldName="'translation_incorrect_words.' . $locale->locale" />
                    </div>
                @endforeach
                <x-form.btn-submit/>
            </div>
        </form>
    </div>
</div>
