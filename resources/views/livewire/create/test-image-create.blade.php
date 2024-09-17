<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add audio image for testing 
        </div>

        <form action="{{route('testImage.store')}}" method="post" enctype="multipart/form-data"  
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            <div class="px-4 py-6 bg-white rounded-sm">
                @include('includes.exerciseParts.create.options')
                <div class="flex flex-row w-full gap-10 mb-2">
                    @include('includes.exerciseParts.create.image_file', ['name'=> 'correct_image', 'message'=> 'message1', 'label' => 'label1', 'title' => 'upload correct image' ]) 
                    @include('includes.exerciseParts.create.image_file', ['name'=> 'incorrect_image', 'message'=> 'message2', 'label' => 'label2', 'title' => 'upload incorrect image']) 
                    @include('includes.exerciseParts.create.sound_file')
                </div>
                <x-form.btn-submit/>
            </div>
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
