{{-- @extends('layout')

@section('content') --}}
    <div class="container text-center mt-5">
        <h1 class="text-danger">404 - Page Not Found</h1>
        <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>

        <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
    </div>
@endsection
