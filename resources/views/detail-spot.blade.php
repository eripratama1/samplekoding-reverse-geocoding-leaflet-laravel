@extends('layouts.app')

@section('style-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="float-end">
                            <img src="{{$spot->getImagePath()}}"
                            width="200"
                            class="img-fluid"
                            alt="{{$spot->name}}"
                            data-slug="{{$spot->slug}}"
                            id="imgspot"
                            >
                        </div>
                        <h4>
                            <strong>{{$spot->name}}</strong><br>
                            <span class="badge rounded-pill text-bg-success">{{$spot->category->name}}</span>
                        </h4>
                        <p>{{$spot->description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="map" style="height: 500px; border-radius:8px;"></div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('assets/js/dataSpot.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            detailSpot()
        })
    </script>
@endpush
