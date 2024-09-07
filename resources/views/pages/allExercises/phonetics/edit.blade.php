@extends('layouts.main')
@section('content')
    @livewire('edit.phonetics-edit',['phonetics' => $phonetics,'lessons' => $lessons, "exercises" => $exercises])
@endsection