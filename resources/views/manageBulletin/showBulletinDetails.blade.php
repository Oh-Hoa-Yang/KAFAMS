@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Bulletin Details</h2>
    <div class="card">
        <div class="card-header">
            {{ $bulletin->bulletinTitle }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Category: {{ $bulletin->bulletinCategory }}</h5>
            <p class="card-text">{{ $bulletin->bulletinMessage }}</p>
            <p class="card-text"><small class="text-muted">Posted on: {{ $bulletin->created_at }}</small></p>
            <p class="card-text"><small class="text-muted">Last updated: {{ $bulletin->updated_at }}</small></p>
            <a href="{{ route('manageBulletin.bulletinList') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
