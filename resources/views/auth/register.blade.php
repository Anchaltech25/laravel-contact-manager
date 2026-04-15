@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:center; align-items:center; min-height:80vh;">
    
    <div style="width:100%; max-width:450px; padding:30px; border:1px solid #ddd; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.05); background:#fff;">
        
        <h2 style="text-align:center; margin-bottom:20px;">Register</h2>

        <form method="POST" action="{{ route('users.create') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name') <div class="small" style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email') <div class="small" style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <label>Password</label>
                <input type="password" name="password">
                @error('password') <div class="small" style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation">
            </div>

            <div class="form-row">
                <label>Role</label>
                <select name="role_id">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <label>Profile Image</label>
                <input type="file" name="profile_image">
            </div>

            <button class="btn btn-primary" style="width:100%; margin-top:10px;">
                Register
            </button>

            <div style="text-align:center; margin-top:15px;">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}" style="color:#0b79d0;">Login</a>
            </div>

        </form>
    </div>

</div>
@endsection
