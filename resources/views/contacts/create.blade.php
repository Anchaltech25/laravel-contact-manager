@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Create Contact</h2>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


<form action="{{ route('contacts.save') }}" method="POST" enctype="multipart/form-data">

        @csrf
        @include('contacts.form', ['contact' => null])
        <button class="btn btn-primary mt-3" type="submit">Save</button>
    </form>
</div>
@endsection
