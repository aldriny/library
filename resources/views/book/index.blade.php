@extends('layout')

@section('body')
    <div class="container mt-5 books-section">
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
            <h2>All Books</h2>
            @if (auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('createBook') }}" class="btn btn-primary">Add New Book</a>
            @endif
        </div>

        @if ($books->isEmpty())
            <h3 class="text-center text-danger mt-5">No Books Available!</h3>
        @else
            <div class="row mt-4 justify-content-center">
                @foreach ($books as $book)
                    <div class="col-md-2 mb-4">
                        <a href="{{ route('showBook', ['id' => $book->id]) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-light position-relative">
                                <!-- Book image -->
                                <img src="{{ Str::startsWith($book->book_image, 'http') ? $book->book_image : asset('storage/' . $book->book_image) }}"
                                    alt="{{ $book->title }}" class="card-img-top"
                                    style="height: 200px; object-fit: cover;">

                                <div class="position-absolute top-0 end-0 p-2">
                                    @if (auth()->user() && auth()->user()->role === 'admin')
                                        <!-- Icons for edit and delete -->
                                        <a href="{{ route('showEditBook', ['id' => $book->id]) }}" class="text-edit me-2"
                                            data-toggle="tooltip" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('deleteBook', ['id' => $book->id]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-delete border-0 bg-transparent"
                                                data-toggle="tooltip" title="Delete"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between align-items-center mb-0">
                                        <span class="fw-bold">
                                            <a href="{{ route('showBook', ['id' => $book->id]) }}"
                                                class="text-decoration-none text-dark">{{ $book->title }}</a>
                                        </span>
                                    </h5>
                                    <span class="text-success d-block mb-2">${{ number_format($book->price, 2) }}</span>
                                    <p class="card-text">
                                        <strong class="fw-bold">Author: </strong><a
                                            href="{{ route('showAuthor', ['id' => $book->author->id]) }}">{{ $book->author->name }}</a>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            {{ $books->links() }} <!-- Pagination links -->
        </div>
    </div>
@endsection
