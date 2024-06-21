@extends('layouts.app')
@section('content')
    @if ($news)
        <livewire:news-toggle-component :news="$news->id" />
    @endif
@endsection
