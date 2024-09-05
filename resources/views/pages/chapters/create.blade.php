@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add Chapters
        </div>

        <form action="{{route('chapter.store')}}" method="post" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @foreach ($locales as $locale)
                <x-form.input :name="'title['.$locale->locale.']'" :placeholder="'chapter '. $locale->locale" :labelText="'chapter '. $locale->name" :errorMessage="$errors->get('title.' . $locale->locale)" />
            @endforeach
            <x-form.btn-submit/>
        </form>
    </div>
@endsection