@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add Lesson
        </div>
        <form action="{{route('lessons.store')}}" method="post" enctype="multipart/form-data" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
                <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an chapter</label>
                <select id="chapters" name="chapter_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>Choose a chapter</option>
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

            <div class="flex flex-row justify-between gap-2 my-2">
                @for ($i = 1; $i < 5; $i++)
                    @include('includes.exerciseParts.create.image_file',['label' => 'button'.$i, 'title' => 'Upload dopamine'.$i, 'name' => 'dopamine_image_'.$i,'message' => 'message'.$i ])
                @endfor
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