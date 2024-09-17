<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit question image 
        </div>
        <form action="{{route('questionImage.update',['questionImage' => $questionImage->id])}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method('PATCH')
            <div class="bg-white px-4 py-6 rounded-sm mb-2">
                <div class="flex flex-row w-full gap-6 mb-4">
                    <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                    <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
                    <x-form.edit.exercises-option :exercises="$exercises" :exerciseId="$exercise_id" :locales="$locales" :switch_exercise="$switch_exercise" />
                </div>
                <x-form.edit-input name="correct_text" :value="$questionImage->correct_text" labelText="English correct word" :errorMessage="$errors->get('correct_text')" />
                <x-form.edit-input name="incorrect_text" :value="$questionImage->incorrect_text" labelText="English incorrect word" :errorMessage="$errors->get('incorrect_text')" />
                <div class="flex flex-row gap-10 w-full">
                    @include('includes.exerciseParts.create.image_file') 
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            </div>
            <x-form.order :request="$questionImages" :currentOrder="$questionImage"></x-form.order>
            <x-form.btn-submit name="update" />
        </form>
    </div>
</div>
