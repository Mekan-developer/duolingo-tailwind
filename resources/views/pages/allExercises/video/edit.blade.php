@extends('layouts.main')
@section('content')
    @livewire("edit.video-edit",['video' => $video,'lessons' => $lessons])
@endsection