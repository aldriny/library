@extends('layout')

@section('body')
    <div class="container mt-5">
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('authors') }}" class="">
                < All Authors</a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Author Information</h3>
            <div>
                @if (auth()->user() && auth()->user()->role === 'admin')
                    <a href="{{ route('editAuthor', ['id' => $author->id]) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                    <form action="{{ route('deleteAuthor', ['id' => $author->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this author?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="row g-0">
            <div class="col-md-4 text-center">
                <img src="{{ Str::startsWith($author->author_image, 'http') ? $author->author_image : asset('storage/' . $author->author_image) }}"
                    alt="{{ $author->name }}" class="img-fluid rounded-circle"
                    style="width: 150px; height: 150px; object-fit: cover;">
                <h4 class="fw-bold mt-3">{{ $author->name }}</h4>
            </div>
            <div class="col-md-8">
                <div class="p-3">
                    <h2 class="card-title fw-bold mb-0">{{ $author->name }}</h2>
                    <p><strong>Birthdate:</strong> {{ $author->birthdate }}</p>
                    <p><strong>Biography:</strong><br>{{ $author->biography }}</p>
                </div>
            </div>
        </div>

        <h4 class="mt-4 mb-4">Books by {{ $author->name }}</h4>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-2 mb-4">
                    <a href="{{ route('showBook', ['id' => $book->id]) }}" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{ Str::startsWith($book->book_image, 'http') ? $book->book_image : asset('storage/' . $book->book_image) }}"
                                alt="{{ $author->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                                <p class="card-text"><span
                                        class="text-success">${{ number_format($book->price, 2) }}</span></p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Add pagination links -->
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
@endsection
