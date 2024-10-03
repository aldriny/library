@extends('layout')

@section('title')
    Library | Home Page
@endsection

@section('body')
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{session('success') }}
</div>
@endif
    <!-- Hero Section -->
    <div class="hero-section"
        style="background-image: url('{{ asset('storage/hero-image.jpg') }}'); height: 450px; background-size: cover; position: relative;">
        <div class="overlay d-flex align-items-center justify-content-start"
            style="background-color: rgba(0, 0, 0, 0.5); height: 100%;">
            <div class="hero-content p-4">
                <h1 class="display-4 text-light font-weight-bold">Discover Your Next Great Read</h1>
                <p class="lead text-light">Join our community of book lovers.</p>
                <a href="{{ route('categories') }}" class="btn btn-primary mt-3"
                    style="background-color: #003366; border: none;">Browse Categories</a>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <!-- Categories Section -->
        <div class="categories-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold" style="color: #003366;">All Categories</h2>
                <a href="{{ route('categories') }}" class="btn btn-outline-secondary"
                    style="border-color: #003366; color: #003366;">See All</a>
            </div>
            @if ($categories->isEmpty())
                <h3 class="text-center text-danger">No Categories Available!</h3>
            @else
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('showCategory', ['id' => $category->id]) }}" class="text-decoration-none">
                                <div class="card h-100 shadow-sm border-light position-relative"
                                    style="background-image: url('{{ asset('storage/category_image.jpeg') }}'); 
                                         background-size: cover; 
                                         background-position: center; 
                                         color: white;">
                                    <div
                                        class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                        <h2 class="card-title fw-bold display-5">{{ $category->title }}</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Books Section -->
        <div class="books-section mt-5 custom-carousel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold" style="color: #003366;">All Books</h2>
                <a href="{{ route('books') }}" class="btn btn-outline-secondary"
                    style="border-color: #003366; color: #003366;">See All</a>
            </div>
            @if ($books->isEmpty())
                <h3 class="text-center text-danger">No Books Available!</h3>
            @else
                <div id="booksCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($books->chunk(5) as $chunk)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row justify-content-center">
                                    @foreach ($chunk as $book)
                                        <div class="col-md-2 mb-4">
                                            <a href="{{ route('showBook', ['id' => $book->id]) }}"
                                                class="text-decoration-none text-dark">
                                                <div class="card h-100 shadow-sm border-light position-relative"
                                                    style="width: 180px;">
                                                    <img src="{{ Str::startsWith($book->book_image, 'http') ? $book->book_image : asset('storage/' . $book->book_image) }}"
                                                        alt="{{ $book->title }}" class="card-img-top"
                                                        style="height: 200px; object-fit: cover;">

                                                    <div class="card-body" style="height: 150px;">
                                                        <h5 class="card-title mb-1">
                                                            <span class="text-dark fw-bold">{{ $book->title }}</span>
                                                        </h5>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span
                                                                class="text-success fw-bold">${{ number_format($book->price, 2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="carousel-controls">
                        <a class="carousel-control-prev" href="#booksCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" style="filter: invert(1); font-size: 20px;"
                                aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#booksCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" style="filter: invert(1); font-size: 20px;"
                                aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Authors Section -->
        <div class="authors-section mt-5 custom-carousel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold" style="color: #003366;">All Authors</h2>
                <a href="{{ route('authors') }}" class="btn btn-outline-secondary"
                    style="border-color: #003366; color: #003366;">See All</a>
            </div>
            @if ($authors->isEmpty())
                <h3 class="text-center text-danger">No Authors Available!</h3>
            @else
                <div id="authorsCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($authors->chunk(5) as $chunk)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="row justify-content-center">
                                    @foreach ($chunk as $author)
                                        <div class="col-md-2 mb-4 text-center">
                                            <a href="{{ route('showAuthor', $author->id) }}"
                                                class="text-decoration-none text-dark d-block">
                                                <img src="{{ Str::startsWith($author->author_image, 'http') ? $author->author_image : asset('storage/' . $author->author_image) }}"
                                                    alt="{{ $author->name }}" class="rounded-circle"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                                <h4 class="fw-bold mt-3">{{ $author->name }}</h4>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="carousel-controls">
                        <a class="carousel-control-prev" href="#authorsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" style="filter: invert(1); font-size: 20px;"
                                aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#authorsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" style="filter: invert(1); font-size: 20px;"
                                aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
        
    </div>
@endsection
