<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add Spelling word
        </div>

        <form action="{{route('spelling.store')}}" method="post" enctype="multipart/form-data"  class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            <div class="bg-white px-4 py-6 rounded-sm">
                <div class="flex flex-row w-full gap-6">
                    <div class="w-full">
                        <label  class="block mb-2 text-sm font-medium text-gray-900" for="mySelect">Select an chapter</label>
                        <select wire:model="selectedChapter" wire:change="selectedChapterHandle" id="mySelect" name="chapter_id" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option selected>Choose a chapter</option>
                            @foreach ($chapters as $chapter)
                                <option class="" value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('chapter_id')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        @if($lessons != null && !$this->lessons->isEmpty())
                            <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900">Select an lesson</label>
                            <select wire:model="selectedLesson" wire:change="selectedLessonHandle" id="chapters" name="lesson_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Choose a lesson</option>
                                @foreach ($lessons as $lesson)
                                    <option value="{{$lesson->id}}">{{ $lesson->getTranslation('title',$locales[0]['locale']) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lesson_id')" class="mt-2" />
                        @endif
                    </div>
                    <div class="w-full">
                        @if($exercises != null && !$this->exercises->isEmpty())
                            <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900">Select an exercise</label>
                            <select id="chapters" name="exercise_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Choose a exercise</option>
                                @foreach ($exercises as $exercises)
                                    <option value="{{$exercises->id}}">{{ $exercises->getTranslation('title',$locales[0]['locale']) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('exercise_id')" class="mt-2" />
                        @endif
                    </div>
                </div>
    
                <div class="mb-4">
                    <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900">English word</label>
                    <input type="text" name="en_text" placeholder="word en" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">                   
                </div>
                <div class="relative w-full">
                    <label title="Click to upload" for="fileInput" class="cursor-pointer flex items-center gap-4 px-6 py-2 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
                        <div class="w-max relative">
                            <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
                        </div>
                        <div class="relative">
                            <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                                Upload image
                            </span>
                            <span id="message" class="mt-0.5 block text-sm text-blue-900 h-[20px]"></span>
                        </div>
                        </label>
                    <input hidden="" type="file" name="image" id="fileInput">
                </div>
            </div>
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
    </script>
    
</div>
