<div>
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add video
        </div>
        <form action="{{route('video.store')}}" method="POST" id="myForm" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md"  enctype="multipart/form-data">
            @csrf
            <div class="flex flex-row w-full gap-6 my-4">
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
                            <option selected>Choose a chapter</option>
                            @foreach ($lessons as $lesson)
                                <option value="{{$lesson->id}}">{{ $lesson->getTranslation('title',$locales[0]['locale']) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('lesson_id')" class="mt-2" />
                    @endif
                </div>
                <div class="w-full">
                    @if($exercises != null && !$this->exercises->isEmpty())
                        <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900">Select an lesson</label>
                        <select id="chapters" name="exercise_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Choose a chapter</option>
                            @foreach ($exercises as $exercises)
                                <option value="{{$exercises->id}}">{{ $exercises->getTranslation('title',$locales[0]['locale']) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('exercise_id')" class="mt-2" />
                    @endif
                </div>
            </div>
            
            <div class="relative w-full">
                <label title="Click to upload" for="fileInput" class="cursor-pointer flex items-center gap-4 px-6 py-2 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-sm before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
                    <div class="w-max relative">
                        <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
                    </div>
                    <div class="relative">
                        <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                            Upload image
                        </span>
                    </div>
                </label>
                <input hidden="" type="file" name="video[]" id="fileInput" accept="image/*,video/*" multiple>
            </div>
            <div class="p-2 m-2 rounded-sm bg-gray-200 flex flex-col gap-4">
                <div class="flex flex-row w-full overflow-hidden overflow-x-auto">
                    <span  id="preview" class="w-[200px] h-auto rounded-lg flex gap-10"></span>
                </div>
                {{-- <div class="flex flex-row w-full">
                    <span id="message" class="text-sm text-blue-900 h-[20px] flex gap-15"></span>
                </div> --}}
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
    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            const files = this.files; // Get all selected files
            const preview = document.getElementById('preview');
            preview.innerHTML = ''; // Clear any previous content

            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    const fileSizeInMB = file.size / (1024 * 1024); // Convert size to MB
                    const reader = new FileReader();

                    // Load the file and display it as an image or video
                    reader.onload = function(e) {
                        if (file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            preview.appendChild(img);
                        } else if (file.type.startsWith('video/')) {
                            const video = document.createElement('video');
                            video.src = e.target.result;
                            video.controls = true;
                            preview.appendChild(video);
                        }
                    };
                    reader.readAsDataURL(file); // Read the file as a Data URL
                });
            } else {
                message.textContent = 'No files chosen.';
            }
        });
    </script>
</div>
