@extends('layouts.main')
@section('content')
    @livewire("edit.vocabulary-edit",['vocabulary' => $vocabulary,'lessons' => $lessons, "exercises" => $exercises])
@endsection