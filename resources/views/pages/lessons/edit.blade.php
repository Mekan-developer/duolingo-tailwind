@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit Lesson
        </div>
        <form action="{{route('lessons.update',['lesson' => $lesson->id])}}" method="post" enctype="multipart/form-data" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method("PATCH")
                <label for="chapters" class="block mb-2 text-sm text-gray-900 dark:text-white">Select an chapter</label>
                <select id="chapters" name="chapter_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach ($chapters as $chapter)
                        <option @if($chapter->id == $lesson->chapter_id) selected @endif value="{{$chapter->id}}">{{ $chapter->name }}</option>
                        {{-- <option @if($chapter->id == $lesson->chapter_id) selected @endif value="{{$chapter->id}}">{{ $chapter->getTranslation('title',$locales[0]['locale']) }}</option> --}}
                    @endforeach
                </select>
                <x-form.edit-input name="name" :value="$lesson->name" labelText="lesson name" :errorMessage="$errors->get('name')" />
            <x-form.order :request="$lessons" :currentOrder="$lesson"></x-form.order>
            <button type="submit" class="w-full py-4 bg-[var(--bg-color-active)] rounded-md text-white text-[18px]"> save </button>
        </form>
    </div>
@endsection