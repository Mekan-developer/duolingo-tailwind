@extends('layouts.main')
@section('content')
    <div class="flex flex-row justify-center w-full p-10">
        <form action="{{route('lessons.store')}}" method="post" class="w-full mx-auto">
            @csrf
                <label for="chapters" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an chapter</label>
                <select id="chapters" name="chapter_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>Choose a chapter</option>
                    @foreach ($chapters as $chapter)
                        <option value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option>
                    @endforeach
                </select>
  
            @foreach ($locales as $locale)
                <div class="mb-5">
                    <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">lesson {{ $locale->locale }}</label>
                    <input type="text" name="title[{{$locale->locale}}]" placeholder="chapter {{$locale->locale}}" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <x-input-error :messages="$errors->get('title[{{$locale->locale}}]')" class="mt-2" />
                </div>
            @endforeach

            <button type="submit" class="w-full py-4 bg-[var(--bg-color-active)] rounded-md text-white text-[18px]"> save </button>
        </form>
    </div>
@endsection