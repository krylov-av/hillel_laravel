@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form method="POST">
                    @csrf
                    @error('username')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="username">Login</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

            </div>
        </div>
    </div>

@endsection
