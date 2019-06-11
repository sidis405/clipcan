@extends('layouts.app')

@section('content')
<h4>Latest images</h4>
<div class="row">
    @foreach($images as $image)
        <div class="col-md-3">
            <div class="card">
              <img src="{{ $image->thumb }}" class="card-img-top" alt="{{ $image->title }}">
              <div class="card-body">
                <h5 class="card-title">{{ $image->title }}</h5>
                <p class="card-text">Tags: {{ $image->tags->pluck('name')->implode(', ') }}</p>
                <p class="card-text">Albums: {{ $image->albums->pluck('title')->implode(', ') }}</p>
                <p class="card-text">Author: <strong>{{ $image->user->name }}</strong></p>
                <a href="{{ url($image->original) }}" class="btn btn-primary" target="_blank">See Original</a>
              </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
