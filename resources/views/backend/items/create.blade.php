@extends('layouts.backend.master')

@section('title', $title)

@push('add_css')

@endpush
@section('content')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">{{ $title }}</h4>
                    </div>
                </div>
                <div class="d-flex my-xl-auto left-content">{{ $slogan }}</div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.'.lcfirst($pluralModelName).'.store') }}" method="POST">
                    @csrf
                    @include('backend.'.lcfirst($pluralModelName).'.form')
                    <button type="submit" class="btn btn-primary">انشاء</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('add_js')
    
@endpush
