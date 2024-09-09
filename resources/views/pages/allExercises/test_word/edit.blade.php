@extends('layouts.main')
@section('content')
    @livewire('edit.test-word-edit',['testWord' => $testWord,'lessons' => $lessons, "exercises" => $exercises])
@endsection