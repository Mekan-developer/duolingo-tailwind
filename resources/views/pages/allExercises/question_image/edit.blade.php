@extends('layouts.main')
@section('content')
    @livewire('edit.question-image-edit',['questionImage' => $questionImage,'lessons' => $lessons, "exercises" => $exercises])
@endsection