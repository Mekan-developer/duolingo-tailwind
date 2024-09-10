<div>
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add audio pronunciation
        </div>
        <form action="{{route('pronunciation.store')}}" method="POST" id="myForm" 
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" 
         enctype="multipart/form-data" onsubmit="disableButton()">
            @csrf
            @include('includes.exerciseParts.create.options')
            @include('includes.exerciseParts.create.sound_file',['title' => 'Upload pronunciation'])
            <x-form.btn-submit class="mt-4"/>
        </form>
    </div>
</div>
