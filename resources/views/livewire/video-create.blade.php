<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add video
        </div>
        <form action="{{route('video.store')}}" method="POST" id="myForm" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md"  enctype="multipart/form-data">
            @csrf
            @include('includes.exerciseParts.create.options')
            
            @include('includes.exerciseParts.create.image_file')

            <div class="p-2 m-2 rounded-sm bg-gray-200 flex flex-col gap-4">
                <div class="flex flex-row w-full overflow-hidden overflow-x-auto">
                    <span  id="preview" class="w-[200px] h-auto rounded-lg flex gap-10"></span>
                </div>
            </div>            
            <button type="submit" class="w-full py-[14px] bg-[var(--bg-color-active)] rounded-md text-white text-[18px] mt-2"> save </button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
