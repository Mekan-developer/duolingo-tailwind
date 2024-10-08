<div>
    <div>
        <div class="flex flex-col w-full gap-6 p-6">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Edit Lesson
            </div>
            <form action="{{route('list.exercises.update',['list_exercise' => $list_exercise->id])}}" method="post" enctype="multipart/form-data" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
                @csrf
                @method("PATCH")
                <div class="rounded-sm">
                    <div class="flex flex-row w-full gap-6 px-4 py-6 bg-white">
                        <div class="w-full">
                            <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an chapter</label>
                            <select id="chapters"  wire:model="selectedChapter" wire:change="selectedChapterHandle" name="chapter_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($chapters as $chapter)
                                    <option @if($chapter->id == $list_exercise->chapter_id) selected @endif value="{{$chapter->id}}">{{ $chapter->name }}</option>
                                @endforeach
                            </select>
                            @error('chapter_id')
                                <span class="text-red-800 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="lessons" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an lesson</label>
                            <select id="lessons" name="lesson_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected>Choose a lesson</option>
                                @foreach ($lessons as $lesson)
                                    <option @if($lesson->id == $list_exercise->lesson_id) selected @endif value="{{$lesson->id}}">{{ $lesson->name }}</option>
                                @endforeach
                            </select>
                            @error('lesson_id')
                                <span class="text-red-800 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <x-form.edit-input name="name" :value="$list_exercise->name" labelText="Exercise name" :errorMessage="$errors->get('name')" />
                    <x-form.order :request="$list_exercises" :currentOrder="$list_exercise"></x-form.order>
                    <x-form.btn-submit name="update" />
                </div>
            </form>
        </div>
    </div>
</div>
