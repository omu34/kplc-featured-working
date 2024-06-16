@extends('layouts.app')
@section('content')
    @if ($gallery)
        <livewire:gallery-toggle-component :gallery="$gallery->id" />
    @endif
@endsection
