@extends('layout')

@section('body')
    <div class="d-flex justify-content-center align-items-center mt-3" style="min-height: 70vh;">
        <div class="col-md-4">
            <div class="card shadow p-4">
                <!-- Display success message -->
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                <h2 class="card-title text-center mb-4">Login</h2>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Enter your email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Enter your password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-right">
                        <a href="{{ route('password.request')}}">Forgot Password?</a>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
                    </div>

                    <div class="text-center mt-3">
                        <p>New user? <a href="{{ route('showRegister') }}">Sign up here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
