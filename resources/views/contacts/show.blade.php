@extends('layouts.app')

@section('content')
    <a href="{{ route('contacts.index') }}" class="btn">Back</a>
    <h2>{{ $contact->name }}</h2>
    <img src="{{ $contact->profile_image_url }}" alt="" style="width:128px;height:128px;border-radius:50%;object-fit:cover">
    <p>{{ $contact->bio }}</p>

    @auth
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Phone:</strong> {{ $contact->number }}</p>
        <p><strong>Status:</strong> {{ $contact->is_active ? 'Active':'Inactive' }}</p>
    @else
        <p><em>Login to view contact details (email & phone)</em></p>
    @endauth
@endsection
