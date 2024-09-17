<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit test words with audio 
        </div>

        <form action="{{route('testWord.update',['testWord' => $testWord->id ])}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method('PATCH')
            <div class="bg-white px-4 py-6 rounded-sm">
                <div class="flex flex-row w-full gap-6 mb-4">
                    <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                    <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
                    <x-form.edit.exercises-option :exercises="$exercises" :exerciseId="$exercise_id" :locales="$locales" :switch_exercise="$switch_exercise" />
                </div>
                @foreach ($locales as $locale)
                    <x-form.edit-input :name="'translations_word['.$locale->locale.']'" :value="$testWord->getTranslation('translations_word',$locale->locale)" :labelText="'Test word '. $locale->name" :errorMessage="$errors->get('translations_word.' . $locale->locale)" />
                @endforeach

                <div class="mt-2">
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            </div>
        
            <div class="mt-2">
                <x-form.edit-input name="en_correct_text" :value="$testWord->en_correct_text" labelText="English correct text" :errorMessage="$errors->get('en_correct_text')" />
                <x-form.edit-input name="en_incorrect_text" :value="$testWord->en_incorrect_text" labelText="English incorrect text" :errorMessage="$errors->get('en_incorrect_text')" />
                <x-form.order :request="$testWords" :currentOrder="$testWord"></x-form.order>
                <x-form.btn-submit name="update" />
            </div>
        </form>
    </div> 
</div>
