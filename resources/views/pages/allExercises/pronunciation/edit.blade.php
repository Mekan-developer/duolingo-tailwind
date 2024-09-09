@extends('layouts.main')
@section('content')
    @livewire('edit.pronunciation-edit',['pronunciation' => $pronunciation,'lessons' => $lessons, "exercises" => $exercises])
@endsection