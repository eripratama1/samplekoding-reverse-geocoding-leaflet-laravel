@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Update category : {{ $category->name }}</div>
                    <div class="card-body">
                        <form action="{{ route('category.update', $category->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group my-2">
                                <label for="">Category name</label>
                                <input type="text" name="name" value="{{ $category->name }}"
                                    class="form-control @error('name')
                                    is-invalid
                                @enderror">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <img src="{{ $category->icon }}" class="img-fluid my-2" width="100" alt=""><br>
                                <label for="">Upload icon category</label>
                                <input type="file" name="icon"
                                    class="form-control @error('icon')
                                    is-invalid
                                @enderror">
                                @error('icon')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
