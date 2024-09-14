@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Edit Chapters
        </div>

        <form action="{{route('chapter.update',['chapter'=> $chapter->id])}}" method="post" class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md">
            @csrf
            @method("PATCH")
            <x-form.edit-input name="name" :value="$chapter->name" labelText="chapter name" :errorMessage="$errors->get('name')" />
            <x-form.order :request="$chapters" :currentOrder="$chapter"></x-form.order>
            <x-form.btn-submit/>
        </form>
    </div>
@endsection