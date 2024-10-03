@extends('layout')

@section('body')
    <div class="container mt-5">
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('categories') }}" class="">< All Categories</a>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>{{ $category->title }} Books</h3>
            <div>
                @if(auth()->user() && auth()->user()->role === 'admin')
                    <a href="{{ route('editCategory', ['id' => $category->id]) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                    <form action="{{ route('deleteCategory', ['id' => $category->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
        
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-2 mb-4">
                    <a href="{{ route('showBook', ['id' => $book->id]) }}" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{ Str::startsWith($book->book_image, 'http') ? $book->book_image : asset('storage/' . $book->book_image) }}"
                            alt="{{ $book->title }}" class="card-img-top"
                            style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $book->title }}</h5>
                                <p class="card-text"><span class="text-success">${{ number_format($book->price, 2) }}</span></p>
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
