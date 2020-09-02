@extends('layout')

@section('title','List of Ads')

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
            @guest
            <h5 class="card-title"><a href="/{{ $ad->id }}">{{ $ad->title }}</a></h5>
            <p class="card-text">{{-- $ad->description --}}{!! Str::limit($ad->description,20,'...(<a href="/'.$ad->id.'">read more</a>)') !!}</p>
            @endguest
            @auth
                <h5 class="card-title"><a href="/{{ route('ad.create',$ad->id) }}">{{ $ad->title }}</a></h5>
                <p class="card-text">{{-- $ad->description --}}{{ Str::limit($ad->description,40,'...(<a href="'.route('ad.create',$ad->id).'">read more</a>)') }}</p>
            @endauth
            @can('update',$ad)
                <a href="{{ route('ad.create',$ad->id) }}" class="btn btn-primary">update</a>
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
