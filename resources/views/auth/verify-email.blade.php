@extends('layout')

@section('body')
<div class="container mt-5">
    <div>
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success') }}
        </div>
    @endif
        <h3 class="mb-4">Email Verification</h3>
        <p>Please verify your email address. We have sent a verification link to <strong>{{ session('email') }}</strong>.</p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-lg">Resend Verification Email</button>
        </form>
    </div>
</div>
@endsection
