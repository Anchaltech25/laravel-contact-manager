@extends('layouts.app')

@section('content')
    <h2>Login</h2>
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-row">
            <label>Email</label>
            <input type="email" name="email" required value="{{ old('email') }}">
            @error('email')<div class="small" style="color:red">{{ $message }}</div>@enderror
        </div>
        <div class="form-row">
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password')<div class="small" style="color:red">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
@endsection
