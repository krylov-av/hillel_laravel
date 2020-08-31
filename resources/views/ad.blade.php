@extends('layout')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $ad->title }}</h5>
            <p class="card-text">{{ $ad->description }}</p>
            @can('update',$ad)
                <a href="#" class="btn btn-primary">update</a>
            @endcan
            @can('delete',$ad)
                <a href="{{ route('ad_delete',$ad->id) }}" class="btn btn-danger">delete</a>
            @endcan
        </div>
        <div class="card-footer text-muted">
            {{ $ad->created_at->diffForHumans() }} by {{ $ad->user->username }}
        </div>
    </div>
@endsection
