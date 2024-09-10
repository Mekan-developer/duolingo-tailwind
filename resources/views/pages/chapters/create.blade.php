@extends('layouts.main')
@section('content')
    <div class="flex flex-col w-full gap-6 p-6">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Add Chapters
        </div>

        <form action="{{route('chapter.store')}}" method="post" 
        class="w-full mx-auto bg-[var(--bg-color-non-active)] p-6 rounded-md" onsubmit="disableButton()">
            @csrf
            <x-form.input name="name" placeholder="chapter name" labelText="chapter name" :errorMessage="$errors->get('name')" />
            <x-form.btn-submit/>
        </form>
    </div>
@endsection