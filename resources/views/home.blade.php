@extends('layout')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    @forelse($ads as $ad)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title"><a href="/{{ $ad->id }}">{{ $ad->title }}</a></h5>
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
    @empty
    <p>No ads</p>
    @endforelse
    {{-- $ads->links() --}}

@if($ads->count()>0)
    <div class="row">
        <div class="col-6">
            @if($ads->currentPage() != 1)
                <a href="{{ $ads->previousPageUrl() }}" class="btn btn-primary">Prev</a>
            @endif
        </div>
        <div class="col-6 text-right">
            @if($ads->hasMorePages())
                <a href="{{ $ads->nextPageUrl() }}" class="btn btn-primary">Next</a>
            @endif
        </div>
    </div>
@endif

@endsection
