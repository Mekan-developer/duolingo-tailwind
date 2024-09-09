@extends('layouts.main')
@section('content')
    @livewire('edit.test-image-edit',['testImage' => $testImage,'lessons' => $lessons, "exercises" => $exercises])
@endsection