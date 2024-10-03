@extends('layout')

@section('body')
    <div class="container mt-5 authors-section">
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('home') }}" class="">
                < Home</a>
        </div>
        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h2>All Authors</h2>
            @if (auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('createAuthor') }}" class="btn btn-primary">Add New Author</a>
            @endif
        </div>

        @if ($authors->isEmpty())
            <h3 class="text-center text-danger mt-5">No Authors Available!</h3>
        @else
            <div class="row mt-5 justify-content-center">
                @foreach ($authors as $author)
                    <div class="col-md-3 mb-5 text-center position-relative">
                        <!-- Link to show author details -->
                        <a href="{{ route('showAuthor', ['id' => $author->id]) }}" class="text-decoration-none text-dark">
                            <!-- Author image as a circle -->
                            <img src="{{ Str::startsWith($author->author_image, 'http') ? $author->author_image : asset('storage/' . $author->author_image) }}"
                                alt="{{ $author->name }}" class="rounded-circle"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            <h4 class="fw-bold mt-3">{{ $author->name }}</h4>
                        </a>
                        <!-- Icons for edit and delete -->
                        <div class="position-absolute top-0 end-0 p-2">
                            <a href="{{ route('showEditAuthor', ['id' => $author->id]) }}" class="text-edit me-2"
                                data-toggle="tooltip" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('deleteAuthor', ['id' => $author->id]) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-delete border-0 bg-transparent" data-toggle="tooltip"
                                    title="Delete" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            {{ $authors->links() }}
        </div>
    </div>
@endsection
