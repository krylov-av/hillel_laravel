@extends('layout')

@section('title','Manage Ad')

@section('content')
    <form method="post" action="{{ route('ad.create',['id'=>$ad->id ?? null]) }}">
        @csrf
        <div class="form-group">
            <label for="title">Ad Title</label>
            @error('title')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <input type="text" class="form-control" name="title" value="{{ old('title',$ad->title) }}">
        </div>
        <div class="form-group">
            <label for="description">Ad Description</label>
            @error('description')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <textarea class="form-control" name="description" rows="3">{{ old('description',$ad->description) }}</textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="{{ $button }}">
    </form>
@endsection

