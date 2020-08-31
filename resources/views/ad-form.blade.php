@extends('layout')

@section('content')
    <form method="post" action="">
        @csrf
        <div class="form-group">
            <label for="title">Ad Title</label>
            @error('title')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="description">Ad Description</label>
            @error('description')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <input type="submit" class="btn btn-primary" value="Create">
    </form>
@endsection

