<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add Spelling word
        </div>

        <form action="{{route('spelling.store')}}" method="post" enctype="multipart/form-data"  
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            <div class="px-4 py-6 mb-2 bg-white rounded-sm">
                @include('includes.exerciseParts.create.options')
                @include('includes.exerciseParts.create.english_text',['name'=>'en_text','title' => 'English word','placeholder' => 'english word']) 
                <div class="mt-2">
                    @include('includes.exerciseParts.create.image_file')
                </div>
               
            </div>
            <x-form.btn-submit/>
        </form>
    </div>    
</div>
