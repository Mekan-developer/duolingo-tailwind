@extends('layouts.main')
@section('content')
    <div class="flex flex-col gap-6 w-full p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit Chapters
        </div>

        <form action="{{route('chapter.update',['chapter'=> $chapter->id])}}" method="post" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method("PATCH")
            @foreach ($locales as $locale)
                <div class="mb-5">
                    <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">chapter {{ $locale->name }}</label>
                    <input type="text" name="title[{{$locale->locale}}]" value="{{ $chapter->getTranslation('title',$locale->locale) }}" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <x-input-error :messages="$errors->get('title[{{$locale->locale}}]')" class="mt-2" />
                </div>
            @endforeach
            <div class="flex w-full justify-end my-1">
                <div class="flex gap-2 items-center w-[100px]">
                    <span>order</span>
                    <select id="small" name="order" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                        @foreach($chapters as $chap)
                            <option @if($chapter->order == $chap->order) selected @endif>{{$chap->order}}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <button type="submit" class="w-full py-4 bg-[var(--bg-color-active)] rounded-md text-white text-[18px]"> save </button>
        </form>
    </div>
@endsection