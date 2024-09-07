<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit question word
        </div>

        <form action="{{route('questionWord.update',['questionWord' => $questionWord->id])}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method("PATCH")
            <div class="bg-white px-4 py-6 rounded-sm">
                <div class="flex flex-row w-full gap-6 mb-4">
                    <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                    <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
                    <x-form.edit.exercises-option :exercises="$exercises" :exerciseId="$exercise_id" :locales="$locales" :switch_exercise="$switch_exercise" />
                </div>
                <x-form.edit-input name="en_text" :value="$questionWord->en_text" labelText="English word" :errorMessage="$errors->get('en_text')" />
                @include('includes.exerciseParts.create.sound_file')
            </div>
            <div class="mt-2">
                @foreach ($locales as $locale)
                    <x-form.edit-input :name="'translations_word['.$locale->locale.']'" :value="$questionWord->getTranslation('translations_word',$locale->locale)" :labelText="'Translate '. $locale->name" :errorMessage="$errors->get('translations_word.' . $locale->locale)" />
                @endforeach
                <x-form.order :request="$questionWords" :currentOrder="$questionWord"></x-form.order>        
                <x-form.btn-submit/>
            </div>
        </form>
    </div>
</div>