@extends('layout')

@section('body')

<div class="d-flex justify-content-center align-items-center mt-3" style="min-height: 70vh;">
    <div class="col-md-4">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Edit Author</h2>
            <form action="{{ route('editAuthor', ['id' => $author->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="name">Author Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter author name" value="{{ old('name', $author->name) }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bio">Biography</label>
                    <textarea class="form-control" name="biography" id="bio" placeholder="Enter biography">{{ old('biography', $author->biography) }}</textarea>
                    @error('biography')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" class="form-control" name="birthdate" id="birthdate" value="{{ old('birthdate', $author->birthdate) }}">
                    @error('birthdate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <label for="inputGroupFile01">Upload photo</label>
                <div class="custom-file">
                    <input type="file" name="author_image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose photo</label>
                </div>
                @error('author_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
