@extends('layouts.main')
@section('content')
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add Lesson
        </div>
        <form action="{{route('lessons.store')}}" method="post" enctype="multipart/form-data" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
                <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an chapter</label>
                <select id="chapters" name="chapter_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    {{-- <option selected>Choose a chapter</option> --}}
                    @foreach ($chapters as $chapter)
                        <option value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option>
                    @endforeach
                </select>
  
            @foreach ($locales as $locale)
                <div class="mb-5">
                    <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">lesson {{ $locale->name }}</label>
                    <input type="text" required name="title[{{$locale->locale}}]" placeholder="chapter {{$locale->locale}}" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <x-input-error :messages="$errors->get('title[{{$locale->locale}}]')" class="mt-2" />
                </div>
            @endforeach

            <div class="flex flex-row justify-between my-2">
                <div>
                    <div class="relative">
                        <label title="Click to upload" for="button1" class="cursor-pointer flex items-center gap-4 px-6 py-2 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                          <div class="w-max relative">
                              <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
                          </div>
                          <div class="relative">
                              <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                                  Upload dopamine 1
                              </span>
                              <span class="mt-0.5 block text-sm text-gray-500">Max 2 MB</span>
                          </div>
                         </label>
                        <input hidden="" type="file" name="dopamine_image_1" id="button1" required>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <label title="Click to upload" for="button2" class="cursor-pointer flex items-center gap-4 px-6 py-2 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                          <div class="w-max relative">
                              <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
                          </div>
                          <div class="relative">
                              <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                                  Upload dopamine 2 
                              </span>
                              <span class="mt-0.5 block text-sm text-gray-500">Max 2 MB</span>
                          </div>
                         </label>
                        <input hidden="" type="file" name="dopamine_image_2" id="button2">
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <label title="Click to upload" for="button3" class="cursor-pointer flex items-center gap-4 px-6 py-2 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                          <div class="w-max relative">
                              <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
                          </div>
                          <div class="relative">
                              <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                                  Upload dopamine 3
                              </span>
                              <span class="mt-0.5 block text-sm text-gray-500">Max 2 MB</span>
                          </div>
                         </label>
                        <input hidden="" type="file" name="dopamine_image_3" id="button3">
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <label title="Click to upload" for="button4" class="cursor-pointer flex items-center gap-4 px-6 py-2 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                          <div class="w-max relative">
                              <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
                          </div>
                          <div class="relative">
                              <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                                  Upload dopamine 4
                              </span>
                              <span class="mt-0.5 block text-sm text-gray-500">Max 2 MB</span>
                          </div>
                         </label>
                        <input hidden="" type="file" name="dopamine_image_4" id="button4">
                    </div>
                </div>
            </div>
            <button type="submit" class="w-full py-4 bg-[var(--bg-color-active)] rounded-md text-white text-[18px]"> save </button>
        </form>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">{{$error}}</span>
                </div>
            @endforeach
        @endif
    </div>
@endsection