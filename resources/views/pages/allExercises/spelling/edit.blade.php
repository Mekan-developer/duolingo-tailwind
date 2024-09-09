@extends('layouts.main')
@section('content')
    @livewire('edit.spelling-edit',['spelling' => $spelling,'lessons' => $lessons, "exercises" => $exercises])
@endsection