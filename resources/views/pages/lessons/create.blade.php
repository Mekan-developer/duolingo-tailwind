@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add Lesson
        </div>
        <form action="{{route('lessons.store')}}" method="post" enctype="multipart/form-data" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            <label for="chapters" class="block mb-2 text-sm text-gray-900 dark:text-white">Select an chapter</label>
            <select id="chapters" name="chapter_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Choose a chapter</option>
                @foreach ($chapters as $chapter)
                    <option value="{{$chapter->id}}">{{ $chapter->name }}</option>
                @endforeach
            </select>
            @error('chapter_id')
                <span class="text-xs text-red-600">{{ $message }}</span>
            @enderror
            <x-form.input name="name" placeholder="Lesson name" labelText="Lesson name" :errorMessage="$errors->get('name')" />
            <div class="flex flex-row justify-between gap-2 my-2">
                @for ($i = 1; $i < 5; $i++)
                    <div class="flex-1">
                        @include('includes.exerciseParts.create.image_file',['label' => 'button'.$i, 'title' => 'Upload dopamine'.$i, 'name' => 'dopamine_image'.$i,'message' => 'message'.$i ])
                    </div>
                @endfor
            </div>
            <x-form.btn-submit/>
        </form>
    </div>
@endsection