@extends('layouts.main')
@section('content')
    @livewire('edit.grammar-theory-edit' ,['grammar' => $grammar,'lessons' => $lessons])
@endsection