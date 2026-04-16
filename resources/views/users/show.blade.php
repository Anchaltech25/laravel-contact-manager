@extends('layouts.app')

@section('content')

<div style="
    display:flex; 
    justify-content:center; 
    align-items:center;
    height:80vh;
    background:#f5f7fa;
">

    <div style="
        width:420px;
        background:#fff;
        border-radius:16px;
        box-shadow:0 8px 25px rgba(0,0,0,0.1);
        padding:30px;
        text-align:center;
    ">

        <!-- PROFILE IMAGE -->
       <div style="margin-bottom:15px; display:flex; justify-content:center;">
    @if($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}"
             style="
                width:110px;
                height:110px;
                border-radius:50%;
                object-fit:cover;
                border:3px solid #eee;
             ">
                @else
                    @php
                        $colors = ['#ef4444', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'];
                        $color = $colors[$user->id % count($colors)];
                        $nameParts = explode(' ', $user->name);
                        $initials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
                    @endphp

                    <div style="
                        width:110px;
                        height:110px;
                        border-radius:50%;
                        background:{{ $color }};
                        color:white;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:32px;
                        font-weight:700;
                    ">
                        {{ $initials }}
                    </div>
                @endif
            </div>


        <!-- NAME -->
        <h2 style="margin:10px 0; font-weight:600;">
            {{ $user->name }}
        </h2>

        <!-- EMAIL -->
       <p style="color:#333; font-size:14px; font-weight:500;">
            {{ $user->email }}
        </p>

        <!-- ROLE BADGE -->
        <div style="margin:15px 0;">
            <span style="
                background:#4f46e5;
                color:white;
                padding:6px 14px;
                border-radius:20px;
                font-size:12px;
                font-weight:500;
            ">
                {{ strtoupper($user->role->name ?? 'N/A') }}
            </span>
        </div>
            <h3 style="margin-top:30px;">User Contacts</h3>

@if($user->contacts->count() > 0)

    <div style="margin-top:10px;">
        @foreach($user->contacts as $contact)

            @php
                $colors = ['#ef4444', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'];
                $color = $colors[$contact->id % count($colors)];
                $initial = strtoupper(substr($contact->name, 0, 1));
            @endphp

            <div style="
                display:flex;
                align-items:center;
                gap:10px;
                padding:10px;
                border-bottom:1px solid #eee;
            ">

                <!-- Avatar -->
                <div style="
                    width:35px;
                    height:35px;
                    border-radius:50%;
                    background:{{ $color }};
                    color:white;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:14px;
                    font-weight:bold;
                ">
                    {{ $initial }}
                </div>

                <!-- Info -->
                <div>
                    <div>{{ $contact->name }}</div>
                    <div style="font-size:12px; color:#666;">
                        {{ $contact->email }}
                    </div>
                </div>

            </div>

        @endforeach
    </div>

@else
    <p style="color:gray;">No contacts found.</p>
@endif


        <!-- DIVIDER -->
        <hr style="margin:20px 0; border:none; border-top:1px solid #eee;">

        <!-- ACTION BUTTONS -->
        <div style="display:flex; justify-content:center; gap:10px;">

            <a href="{{ route('users.edit', $user->id) }}" 
               style="
                   background:#22c55e;
                   color:white;
                   padding:10px 18px;
                   border-radius:8px;
                   text-decoration:none;
                   font-weight:500;
               ">
                Edit Profile
            </a>

            @if(auth()->user()->role_id == 1)
                <a href="{{ route('users.index') }}" 
                   style="
                       padding:10px 18px;
                       border-radius:8px;
                       text-decoration:none;
                       border:1px solid #ccc;
                       color:#333;
                   ">
                    Back
                </a>
            @else
                <a href="{{ route('contacts.index') }}" 
                   style="
                       padding:10px 18px;
                       border-radius:8px;
                       text-decoration:none;
                       border:1px solid #ccc;
                       color:#333;
                   ">
                    Back
                </a>
            @endif

        </div>

    </div>

</div>

@endsection
