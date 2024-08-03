@extends('layouts.app')

@section('style-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div id="map" style="height:380px; border-radius:10px;"></div>
            </div>
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">Update data spot : {{ $spot->name }}</div>
                    <div class="card-body">
                        <form action="{{ route('spot.update',$spot->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group my-2">
                                <label for="">Spot Name</label>
                                <input type="text" name="name" id="name" value="{{$spot->name}}"
                                    class="form-control @error('name')
                                    is-invalid
                                @enderror"
                                    id="">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <img src="{{$spot->image_path}}" class="img-fluid my-2" style="width: 300px; border-radius:5px" alt=""><br>
                                <label for="">Upload Image</label>
                                <input type="file" name="image_path"
                                    class="form-control @error('image_path')
                                    is-invalid
                                @enderror"
                                    id="">
                                @error('image_path')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <label for="">Latitude</label>
                                <input type="text" name="lat" id="lat" value="{{$spot->lat}}"
                                    class="form-control @error('lat')
                                    is-invalid
                                @enderror"
                                    id="">
                                @error('lat')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <label for="">Longitude</label>
                                <input type="text" name="lng" id="lng" value="{{$spot->lng}}"
                                    class="form-control @error('lng')
                                    is-invalid
                                @enderror"
                                    id="">
                                @error('lng')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <label for="">Spot Kategori</label>
                                <select name="category_id"
                                    class="form-control @error('category_id')
                                    is-invalid
                                @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}" @if ($item->id === $spot->category_id)
                                            selected
                                        @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <label for="">Deskripsi</label>
                                <textarea name="description" id="description"
                                    class="form-control @error('description')
                                    is-invalid
                                @enderror"
                                    id="" cols="30" rows="10">{{$spot->description}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('assets/js/geocoder.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded',function () {
            updateSpot()
        })
    </script>
@endpush
