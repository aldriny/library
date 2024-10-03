@extends('layout')

@section('body')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Add New Category</h2>
                    <form action="{{ route('createCategory') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Category Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Enter category title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
