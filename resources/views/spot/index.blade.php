@extends('layouts.app')

@section('style-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Spot
                        <a href="{{ route('spot.create') }}" class="btn btn-primary btn-sm float-end">
                            Create new spot
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="spot-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Spot Name</th>
                                    <th scope="col">Category Spot</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
@endpush