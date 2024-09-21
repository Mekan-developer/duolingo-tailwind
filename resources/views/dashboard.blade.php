@extends('layouts.main')
@section("content")
<div class="flex flex-col gap-10 p-1">
    <div class="mx-auto ">
        <div class="mb-10">
            <span class="text-[var(--bg-color-active)] text-[24px] font-bold">Dashboard</span>
        </div>
        <div class="grid grid-col-1 2xl:grid-cols-2 gap-14">
            <x-admin.card icon="bx bx-book-bookmark" route="chapters" title="Chapters" count="{{$chapters}} chapters" text="In this section we can add chapters and manipulate it like Edite, Delete and Reorder, If chapter has lesson then we can not delete it. This each chapter include lessons and exercise:" />
            <x-admin.card icon="bx bxs-book-content" route="lessons" title="Lessons" count="{{$lessons}} lessons" text="In this section we can add lesson and manipulate it like Edite, Delete and Reorder, If lesson has exercise then we can not delete it. This each lesson include lessons and exercise, this each lesson belongs to some one chapter.:" />
            <x-admin.card icon="bx bx-task" route="exercises" title="Exercise types" count="{{$exercises}} Exercises" text="In this section belongs to exercises and each exercise  we can Edite and Reordering.In description column shown Instruction for each 11 (eleven) exercise :" />
            <x-admin.card icon="bx bx-book-reader" route="vocabulary.index" title="All exercises" count="{{$allExercises}} Exercises" text="In this section you can manage all the types of tasks such as creating, deleting, editing, ordering and changing status:" />
            <x-admin.card icon="bx bx-info-circle" route="information.index" title=" informations" count="{{$informations}} informations" text="In this section you can manage all the Informations such as creating, deleting, editing and ordering:" />
            <x-admin.card icon="bx bx-world" route="language.index" title="languages" count="{{$languages}} languages" text="In this section you can manage all the Languages such as creating, deleting, editing and ordering:" />
        </div> 
    </div>
</div>
    
@endsection