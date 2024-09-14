@extends('layouts.main')
@section("content")
<div class="flex flex-col gap-10 p-1">
    <div class="mx-auto ">
        <div class="mb-10">
            <span class="text-[var(--bg-color-active)] text-[24px]">Dashboard</span>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-10 xl:gap-20 2xl:gap-32">
            <x-admin.card icon="bx bx-book-bookmark" route="chapters" title=" Chapters" count="{{$chapters}} chapters" text="In this section you can manage all the chapters such as creating, deleting, editing and ordering:" />
            <x-admin.card icon="bx bxs-book-content" route="lessons" title=" lessons" count="{{$lessons}} lessons" text="In this section you can manage all the lessons such as creating, deleting, editing and ordering:" />
            <x-admin.card icon="bx bx-task" route="list.exercises" title="exercise types" count="{{$exercises}} Exercises" text="In this section you can manage all the Exercises such as creating, deleting, editing and ordering:" />
            <x-admin.card icon="bx bx-book-reader" route="vocabulary.index" title="All exercises" count="{{$allExercises}} Exercises" text="In this section you can manage all the types of tasks such as creating, deleting, editing, ordering and changing status:" />
            <x-admin.card icon="bx bx-info-circle" route="information.index" title=" informations" count="{{$informations}} informations" text="In this section you can manage all the Informations such as creating, deleting, editing and ordering:" />
            <x-admin.card icon="bx bx-world" route="language.index" title="languages" count="{{$languages}} languages" text="In this section you can manage all the Languages such as creating, deleting, editing and ordering:" />
        </div> 
    </div>
    
</div>
    
@endsection