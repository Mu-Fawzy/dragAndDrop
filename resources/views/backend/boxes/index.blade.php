@extends('layouts.backend.master')

@section('title', $title)

@push('add_css')
    
@endpush

@section('content')
    <div class="col-md-8">
        <x-table-card-components :title="$title" :slogan="$slogan" :pluralModelName="$pluralModelName" :lowerModelName="$lowerModelName">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->created_at->format('d M,Y') }}</td>
                            <td>
                                @include('backend.inc.buttons.edit')
                                @include('backend.inc.buttons.delete')
                            </td>
                        </tr>
                    @empty
                        <tr>{{ $nothingHere }}</tr>
                    @endforelse
                </tbody>
            </table>
            
        </x-table-card-components>
    </div>
@endsection

@push('add_js')
    
@endpush
