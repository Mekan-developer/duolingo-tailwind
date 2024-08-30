<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add vocabulary
        </div>

        <form action="{{route('vocabulary.store')}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            <div class="bg-white px-4 py-6 rounded-sm">
                @include('includes.exerciseParts.create.options') 
                @include('includes.exerciseParts.create.english_text',['name'=>'en_text','title' => 'English word','placeholder' => 'english word']) 

                <div class="flex flex-row gap-10 w-full">
                    @include('includes.exerciseParts.create.image_file')
                    @include('includes.exerciseParts.create.sound_file')
                </div>
            </div>
            

            @foreach ($locales as $locale)
                <div class="mb-5">
                    <label for="base-input" class="block  text-sm font-medium text-gray-900">translate {{ $locale->name }}</label>
                    <input type="text" name="translations_word[{{$locale->locale}}]" value="{{ old('translations_word.' . $locale->locale) }}" placeholder="translate {{$locale->locale}}" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <x-input-error :messages="$errors->get('translations_word[{{$locale->locale}}]')" class="mt-2" />
                </div>
            @endforeach

            <button type="submit" class="w-full py-4 bg-[var(--bg-color-active)] rounded-md text-white text-[18px]"> save </button>
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

<script>
document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = this.files[0];
    if (!file) {
        document.getElementById('message').textContent = 'No file chosen.';
    } else if (file.size === 0) {
        document.getElementById('message').textContent = 'The chosen file is empty.';
    } else {
        document.getElementById('message').textContent = 'File choosen!';
    }
});

document.getElementById('fileInput2').addEventListener('change', function(event) {
    const file = this.files[0];
    if (!file) {
        document.getElementById('message2').textContent = 'No file chosen.';
    } else if (file.size === 0) {
        document.getElementById('message2').textContent = 'The chosen file is empty.';
    } else {
        document.getElementById('message2').textContent = 'File choosen!';
    }
});

</script>
    
</div>
