@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="text-center">Kategori {{ $categorySpot->name }}</h2>
                <hr class="my-3">

                <div class="row">
                    @forelse ($categorySpot->spots as $item)
                        <div class="col-md-6 my-2">
                            <div class="card shadow my-2">
                                <div class="card-body">
                                    <div class="float-end">
                                        <img src="{{ $item->getImagePath() }}" width="250" alt="">
                                    </div>
                                    <h4>
                                        <strong>{{ $item->name }}</strong>
                                        <span class="badge rounded-pill text-bg-success">{{ $categorySpot->name }}</span>
                                    </h4>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('detailSpot', $item->slug) }}" class="btn btn-primary btn-sm">Detail
                                        Spot</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h2 class="text-center">Data Empty</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
