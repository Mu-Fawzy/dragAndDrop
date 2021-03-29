@extends('layouts.backend.app')
@push('add_css')
    <style>
        .card-header:first-child {
            display:flex;
        }
    </style>
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @include('backend.inc.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">Boxes</h4>
                            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit</span></div>
                    </div>
                    <div class="d-flex my-xl-auto left-content">
                        Here you can Edit {{ $box->name }}
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.boxes.update', $box) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @include('backend.boxes.form')
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('add_js')
    
@endpush
