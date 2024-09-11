@extends('layouts.main')
@section("content")
<div class="flex flex-col gap-10 p-1">
    <div>
        <span class="text-[var(--bg-color-active)] text-[24px]">Dashboard</span>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4  gap-10">
        <x-admin.card route="chapters" title=" Chapters" text="Go to this step by step guideline process on how to certify for your weekly benefits:" />
        <x-admin.card route="chapters" title=" Chapters" text="Go to this step by step guideline process on how to certify for your weekly benefits:" />
        <x-admin.card route="chapters" title=" Chapters" text="Go to this step by step guideline process on how to certify for your weekly benefits:" />
        <x-admin.card route="chapters" title=" Chapters" text="Go to this step by step guideline process on how to certify for your weekly benefits:" />
        <x-admin.card route="chapters" title=" Chapters" text="Go to this step by step guideline process on how to certify for your weekly benefits:" />
        <x-admin.card route="chapters" title=" Chapters" text="Go to this step by step guideline process on how to certify for your weekly benefits:" />
        <x-admin.card route="chapters" title=" Chapters" text="Go to this step by step guideline process on how to certify for your weekly benefits:" />
    </div> 
</div>
    
@endsection