@extends('layouts.app')

@section('content')
<div style="display:flex; justify-content:center; align-items:center; height:80vh;">
    
    <div style="width:100%; max-width:400px; padding:30px; border:1px solid #ddd; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.05); background:#fff;">
        
        <h2 style="text-align:center; margin-bottom:20px;">Login</h2>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px;">Email</label>
                <input type="email" name="email" required 
                       value="{{ old('email') }}" 
                       style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
                @error('email')
                    <div style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:5px;">Password</label>
                <input type="password" name="password" required 
                       style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
                @error('password')
                    <div style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" 
                    style="width:100%; padding:10px; background:#007bff; color:#fff; border:none; border-radius:5px; cursor:pointer;">
                Login
            </button>

        </form>
    </div>

</div>
@endsection
