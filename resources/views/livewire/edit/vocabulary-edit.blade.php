<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit vocabulary
        </div>

        <form action="{{route('vocabulary.update',['vocabulary' => $vocabulary->id])}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method("PATCH")
            <div class="bg-white px-4 py-6 rounded-sm">
                <div class="flex flex-row w-full gap-6 mb-4">
                    <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                    <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
                    <x-form.edit.exercises-option :exercises="$exercises" :exerciseId="$exercise_id" :locales="$locales" :switch_exercise="$switch_exercise" />
                </div>
                <x-form.edit-input name="en_text" :value="$vocabulary->en_text" labelText="English word" :errorMessage="$errors->get('en_text')" />
                <div class="flex flex-row gap-10 w-full">
                    @include('includes.exerciseParts.create.image_file') 
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            </div>
            
            <div class="mt-4">
                @foreach ($locales as $locale)
                    <x-form.edit-input :name="'translations_word['.$locale->locale.']'" :value="$vocabulary->getTranslation('translations_word',$locale->locale)" :labelText="'Vocabulary '. $locale->name" :errorMessage="$errors->get('translations_word.' . $locale->locale)" />
                @endforeach
                <x-form.order :request="$vocabularies" :currentOrder="$vocabulary"></x-form.order>
                <x-form.btn-submit/>
            </div>
        </form>
    </div>    
</div>