<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit audio image for testing
        </div>

        <form action="{{route('testImage.update',['testImage' => $testImage->id])}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method("PATCH")
            <div class="bg-white px-4 py-6 rounded-sm">
                <div class="flex flex-row w-full gap-6 mb-4">
                    <x-form.edit.chapters-option  :chapters="$chapters" :locales="$locales"/>
                    <x-form.edit.lessons-option :lessons="$lessons" :locales="$locales" :switch_lesson="$switch_lesson"/>
                </div>

                <div class="flex flex-row gap-10 w-full mb-2">
                     @include('includes.exerciseParts.create.image_file', ['name'=> 'correct_image', 'message'=> 'message1', 'label' => 'label1']) 
                    @include('includes.exerciseParts.create.image_file', ['name'=> 'incorrect_image', 'message'=> 'message2', 'label' => 'label2']) 
                    @include('includes.exerciseParts.create.sound_file')
                </div>
                <x-form.order :request="$testImages" :currentOrder="$testImage"></x-form.order>
                <x-form.btn-submit name="update" />
            </div>
        </form>
    </div>    
</div>
