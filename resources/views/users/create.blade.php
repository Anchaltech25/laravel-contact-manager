@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:center; align-items:center; height:80vh;">
    
    <div style="width:100%; max-width:400px; padding:30px; border:1px solid #ddd; border-radius:10px; background:#fff;">
        
        <h2 style="text-align:center; margin-bottom:20px;">Register</h2>

        <form method="POST" action="{{ route('users.create') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-row">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-row">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-row">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <div class="form-row">
                <label>Role</label>
                <select name="role_id" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <label>Profile Image</label>
                <input type="file" name="profile_image">
            </div>

            <button class="btn btn-primary" style="width:100%;">Register</button>
        </form>

    </div>
</div>
@endsection
