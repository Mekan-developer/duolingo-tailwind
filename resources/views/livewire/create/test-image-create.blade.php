<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add audio image for testing
        </div>

        <form action="{{route('testImage.store')}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            <div class="bg-white px-4 py-6 rounded-sm">
                @include('includes.exerciseParts.create.options')
                <div class="flex flex-row gap-10 w-full mb-2">
                    @include('includes.exerciseParts.create.image_file')
                    @include('includes.exerciseParts.create.sound_file')
                </div>
                <x-form.btn-submit/>
            </div>
        </form>
    </div>    
</div>
