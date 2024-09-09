@extends('layouts.main')
@section('content')
    @livewire('edit.listening-edit',['listening' => $listening,'lessons' => $lessons, "exercises" => $exercises])
@endsection