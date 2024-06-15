@extends('layouts.app')
@section('content')
    {{-- @livewire('news-item', ['newsItem' => $newsItem]) --}}
    <div class="container">
        @if ($news)
            <livewire:news-component :news="$news->id" />
        @endif
    </div>
@endsection
