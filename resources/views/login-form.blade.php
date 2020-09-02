<form method="POST" action="{{ route('login') }}">
    @csrf
    @error('username')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('password')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="form-group">
        <label for="username">Login</label>
        <input type="text" class="form-control" name="username" value="{{ old('username') }}">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="remember">
        <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
