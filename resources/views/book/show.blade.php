@extends('layout')

@section('body')
    <div class="container mt-5">
        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-start mb-2">
            <a href="{{ route('books') }}" class="">
                < All Books</a>
        </div>

        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ Str::startsWith($book->book_image, 'http') ? $book->book_image : asset('storage/' . $book->book_image) }}"
                    alt="{{ $book->title }}" class="img-fluid rounded-start" style="height: 350px; object-fit: cover;">

            </div>
            <div class="col-md-8">
                <div class="p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">{{ $book->title }}</h2>
                        <div>
                            @if (auth()->user() && auth()->user()->role === 'admin')
                                <a href="{{ route('showEditBook', ['id' => $book->id]) }}"
                                    class="btn btn-warning btn-sm me-2">Edit</a>
                                <form action="{{ route('deleteBook', ['id' => $book->id]) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <p class="card-text">
                        <span class="text-success mb-3 d-block">${{ number_format($book->price, 2) }}</span>
                        <strong>Author:</strong>
                        <a href="{{ route('showAuthor', ['id' => $book->author->id]) }}">{{ $book->author->name }}</a> <br>
                        <strong>Category:</strong>
                        <a href="{{ route('showCategory', ['id' => $book->category->id]) }}">{{ $book->category->title }}</a> <br>
                        <strong>Description:</strong><br>
                        {{ $book->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
