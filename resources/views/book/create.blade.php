@extends('layout')

@section('body')
    <div class="d-flex justify-content-center align-items-center mt-3" style="min-height: 70vh;">
        <div class="col-md-4">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Add New Book</h2>
                <form action="{{ route('createBook') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Book Title -->
                    <div class="form-group">
                        <label for="title">Book Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            placeholder="Enter book title" value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Book Description -->
                    <div class="form-group">
                        <label for="description">Book Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter book description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price"
                            placeholder="Enter book price" value="{{ old('price') }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Language -->
                    <div class="form-group">
                        <label for="language">Select Book Language</label>
                        <select class="form-control" id="language" name="language">
                            <option>-- Select Language --</option>
                            <option value="english" {{ old('language') == 'english' ? 'selected' : '' }}>English</option>
                            <option value="arabic" {{ old('language') == 'arabic' ? 'selected' : '' }}>Arabic</option>
                            <option value="spanish" {{ old('language') == 'spanish' ? 'selected' : '' }}>Spanish</option>
                        </select>
                        @error('language')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="form-group">
                        <label for="author">Select Author</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" id="author" name="author_id">
                                    <option>-- Select Author --</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}"
                                            {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="button" id="addAuthorBtn" class="btn btn-outline-secondary btn-block">Add New
                                    Author?</button>
                            </div>
                        </div>
                        @error('author_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hidden Add Author Inputs with Transition -->
                    <div id="addAuthorForm" class="mt-3" style="display: none; opacity: 0; transition: opacity 0.5s;">
                        <div class="p-3"
                            style="background-color: #f8f9fa; border: 1px solid #ced4da; border-radius: 5px;">
                            <div class="form-group">
                                <label for="author_name">Author Name</label>
                                <input type="text" class="form-control" name="name" id="author_name"
                                    placeholder="Enter author name">
                            </div>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="bio">Biography</label>
                                <textarea class="form-control" name="biography" id="bio" placeholder="Enter biography"></textarea>
                            </div>
                            @error('biography')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" class="form-control" name="birthdate" id="birthdate">
                            </div>
                            @error('birthdate')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label for="inputGroupFile01">Upload photo</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="author_image">
                                <label class="custom-file-label" for="inputGroupFile01">Choose photo</label>
                            </div>
                            @error('author_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="form-group mt-3">
                        <label for="category">Select Category</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" id="category" name="category_id">
                                    <option>-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="button" id="addCategoryBtn"
                                    class="btn btn-outline-secondary btn-block">Add New Category?</button>
                            </div>
                        </div>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hidden Add Category Inputs with Transition -->
                    <div id="addCategoryForm" class="mt-3"
                        style="display: none; opacity: 0; transition: opacity 0.5s;">
                        <div class="p-3"
                            style="background-color: #f8f9fa; border: 1px solid #ced4da; border-radius: 5px;">
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" name="category" id="category_name"
                                    placeholder="Enter category name">
                            </div>
                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image -->
                    <label for="inputGroupFile01">Upload Book Image</label>
                    <div class="custom-file">
                        <input type="file" name="book_image" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose photo</label>
                    </div>
                    @error('book_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
