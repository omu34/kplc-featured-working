@extends('layouts.app')
@section('content')
    {{-- @livewire('gallery-item', ['galleryItem' => $galleryItem]) --}}

    <div class="container">
        @if ($gallery)
            <livewire:gallery-component :gallery="$gallery->id" />
        @endif
    </div>
@endsection
