<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add video
        </div>
        <form action="{{route('video.update',['video' => $video->id])}}" method="POST" id="myForm" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md"  enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="flex flex-row w-full gap-6 mb-4">
                <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
                <x-form.edit.exercises-option :exercises="$exercises" :exerciseId="$exercise_id" :locales="$locales" :switch_exercise="$switch_exercise" />
            </div>

            @include('includes.exerciseParts.create.video_file')
            <div class="p-2 m-2 rounded-sm bg-gray-200 flex flex-col gap-4">
                <div class="flex flex-row w-full overflow-hidden overflow-x-auto">
                    <span  id="preview" class="w-[200px] h-auto rounded-lg flex gap-10"></span>
                </div>
            </div> 
            <x-form.order :request="$videos" :currentOrder="$video"></x-form.order>           
            <x-form.btn-submit/>
        </form>
    </div>
</div>
