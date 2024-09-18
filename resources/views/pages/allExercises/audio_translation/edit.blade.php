@extends('layouts.main')
@section('content')
    @livewire('edit.audio-translation-edit',['audioTranslation' => $audioTranslation,'lessons' => $lessons])
@endsection