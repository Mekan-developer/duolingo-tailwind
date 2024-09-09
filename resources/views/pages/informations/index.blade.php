@extends('layouts.main')
@section('content')

<div class="flex flex-col w-full relative">
    <x-form.success/>
    <div class="flex flex-row justify-between w-full">
        <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
            Informations
        </div>
        <div>
            <div class="flex flex-row-reverse">
                <a href="" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 mb-2">+</a>
            </div>
        </div>
    </div>

</div>

@endsection