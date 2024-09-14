@extends('layouts.main')
@section('content')
    @livewire("edit.list-exercise-edit",
    [
        "list_exercise" => $list_exercise,
        "lessons" => $lessons 
    ])
@endsection