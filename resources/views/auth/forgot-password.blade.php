@extends('layout')

@section('body')
<div class="container mt-5">
    <div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <h3 class="mb-4">Forgot Password</h3>
        <p>Please enter your email address. We will send you a password reset link.</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
                @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Send Password Reset Link</button>
        </form>
    </div>
</div>
@endsection
