<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit audio pronunciation
        </div>
        <form action="{{route('pronunciation.update',['pronunciation' => $pronunciation->id])}}" method="POST" id="myForm" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md"  enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex flex-row w-full gap-6 mb-4">
                <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
                <x-form.edit.exercises-option :exercises="$exercises" :exerciseId="$exercise_id" :locales="$locales" :switch_exercise="$switch_exercise" />
            </div>
            @include('includes.exerciseParts.create.sound_file',['title' => 'Upload pronunciation'])
            <div class="mt-2">
                <x-form.order :request="$pronunciations" :currentOrder="$pronunciation"></x-form.order>
            </div>
            <x-form.btn-submit name="update" class="mt-4"/>
        </form>
    </div>
</div>
