<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add video
        </div>
        <form action="{{route('video.store')}}" method="POST" id="myForm" enctype="multipart/form-data"
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            @include('includes.exerciseParts.create.options')
            
            @include('includes.exerciseParts.create.video_file')

            <div class="flex flex-col gap-4 p-2 m-2 bg-gray-200 rounded-sm">
                <div class="flex flex-row w-full overflow-hidden overflow-x-auto">
                    <span  id="preview" class="w-[200px] h-auto rounded-lg flex gap-10"></span>
                </div>
            </div>            
            <x-form.btn-submit/>
        </form>
    </div>
</div>
