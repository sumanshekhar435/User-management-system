@extends('layout')
@section('content')
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">

        @session('success')
            <div class="alert alert-success" role="alert">
                {{ $value }}
            </div>
        @endsession

        <h1 class="display-5 fw-bold">Hi, {{ auth()->user()->first_name }}</h1>
        <p class="col-md-8 fs-4">Welcome to dashboard.<br />Here, you can access a variety of features<br />
            and tools to manage your account and explore our platform.</p>
            <a href="{{ route('user-profile') }}" class="btn btn-primary btn-lg">View Profile</a>
    </div>
</div>
@endsection
