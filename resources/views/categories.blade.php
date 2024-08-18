@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-4">
                            <div class="card shadow my-2">
                                <div class="card-body">
                                    <h4 class="text-center">
                                        <a href="{{ route('categorySpot', $category->slug) }}" style="text-decoration: none;">
                                            {{ $category->name }}
                                        </a>
                                        <img src="{{ $category->icon }}" width="85" alt="">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
