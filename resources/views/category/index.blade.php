@extends('layout')

@section('body')
    <div class="container mt-5">
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('home') }}" class="">< Home</a>
        </div>
        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h2>All Categories</h2>
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('createCategory') }}" class="btn btn-primary">Add New Category</a>
            @endif
        </div>

        @if ($categories->isEmpty())
            <h3 class="text-center text-danger mt-5">No Categories Available!</h3>
        @else
            <div class="row mt-5 container categories-section">
                @foreach ($categories as $category)
                    <div class="col-md-4 mb-4">
                        <!-- Make the entire card clickable -->
                        <a href="{{ route('showCategory', ['id' => $category->id]) }}" class="text-decoration-none text-white">
                            <div class="card h-100 shadow-sm position-relative"
                                 style="background-image: url('{{ asset('storage/category_image.jpeg') }}'); background-size: cover; background-position: center; color: white;">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                    <h2 class="card-title fw-bold display-4">{{ $category->title }}</h2>
                                </div>
                                <div class="position-absolute top-0 end-0 p-2">
                                    @if(auth()->user() && auth()->user()->role === 'admin')
                                        <!-- Icons for edit and delete -->
                                        <a href="{{ route('showEditCategory', ['id' => $category->id]) }}" class="text-edit me-2"
                                           data-toggle="tooltip" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('deleteCategory', ['id' => $category->id]) }}" method="POST"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-delete border-0 bg-transparent" data-toggle="tooltip"
                                                    title="Delete" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4">
            {{ $categories->links() }} <!-- Pagination links -->
        </div>
    </div>
@endsection
