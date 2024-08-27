<div>
    <div>
        <div class="flex flex-col gap-6 w-full p-6">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Edit Lesson
            </div>
            <form action="{{route('list.exercises.store')}}" method="post" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6">
                @csrf
                <div class="flex flex-row w-full gap-6 bg-white px-4 py-6 rounded-sm">
                    <div class="w-full">
                        <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an chapter</label>
                        <select wire:model="selectedOption" wire:change="handleOptionChange" id="mySelect" name="chapter_id" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option selected>Choose a chapter</option>
                            @foreach ($chapters as $chapter)
                                <option class="" value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('chapter_id')" class="mt-2" />
                    </div>
                    <div class="w-full">
                        @if($lessons != null && !$this->lessons->isEmpty())
                            <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an lesson</label>
                            <select id="chapters" name="lesson_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Choose a chapter</option>
                                @foreach ($lessons as $lesson)
                                    <option value="{{$lesson->id}}">{{ $lesson->getTranslation('title',$locales[0]['locale']) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lesson_id')" class="mt-2" />
                        @endif
                    </div>
                </div>
                <div class="px-4">
                    @foreach ($locales as $locale)
                        <div class="my-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">lesson {{ $locale->name }}</label>
                            <input type="text" name="title[{{$locale->locale}}]" placeholder="chapter {{$locale->locale}}" id="base-input" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <x-input-error :messages="$errors->get('title[{{$locale->locale}}]')" class="mt-2" />
                        </div>
                    @endforeach
                    <button type="submit" class="w-full py-4 bg-[var(--bg-color-active)] rounded-md text-white text-[18px]"> save </button>
                </div>
                @if ($errors->any())
                    <div class="flex justify-center items-center text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>    
</div>
