@extends('layouts.app')
@section('content')
<h2>Edit Contact</h2>
<form method="POST" action="{{ route('contacts.update', $contact) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('contacts.form', ['contact' => $contact])
    <button class="btn btn-primary" type="submit">Update</button>
</form>
@endsection
