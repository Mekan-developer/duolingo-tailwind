@extends('layouts.main')
@section('content')
    @livewire('edit.information-edit',['information' => $information])
@endsection