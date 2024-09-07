@extends('layouts.main')
@section('content')
    @livewire('edit.question-word-edit',['questionWord' => $questionWord,'lessons' => $lessons, "exercises" => $exercises])
@endsection