@extends('layouts.app')
@section('content')
    {{-- @livewire('vedio-item', ['videoItem' => $videoItem])     --}}
    <div class="container">
        @if ($videos)
            <livewire:videos-component :videos="$videos->id" />
        @endif
    </div>
@endsection
