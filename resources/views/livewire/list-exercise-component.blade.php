<div>
    <div class="flex flex-row justify-center w-full p-10">
        <form action="{{route('list.exercises.store')}}" method="post" class="w-full mx-auto">
            @csrf
            <div class="flex flex-col gap-6 bg-[var(--bg-color-non-active)] px-4 py-6 rounded-sm">
                <div>
                    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an chapter</label>
                    <select wire:model="selectedOption" wire:change="handleOptionChange" id="mySelect" name="chapter_id" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Choose a chapter</option>
                        @foreach ($chapters as $chapter)
                            <option class="" value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('chapter_id')" class="mt-2" />
                </div>
                <div>
                    @if($lessons != null && !$this->lessons->isEmpty())
                        <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an lesson</label>
                        <select id="chapters" name="lesson_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                        <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">lesson {{ $locale->locale }}</label>
                        <input type="text" name="title[{{$locale->locale}}]" placeholder="chapter {{$locale->locale}}" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <x-input-error :messages="$errors->get('title[{{$locale->locale}}]')" class="mt-2" />
                    </div>
                @endforeach
                <button type="submit" class="w-full py-4 bg-[var(--bg-color-active)] rounded-md text-white text-[18px]"> save </button>
            </div>
        </form>
    </div>
</div>
