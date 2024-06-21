@extends('layouts.app')
@section('content')
    @if ($videos)
        <livewire:videos-toggle-component :videos="$videos->id" />
    @endif
@endsection
