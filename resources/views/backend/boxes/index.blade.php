@extends('layouts.backend.master')

@section('title', $title)

@push('add_css')
    
@endpush

@section('content')
    <div class="col-md-9">
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
                                <div class="d-flex justify-content-center">
                                    @include('backend.inc.buttons.edit')
                                    @include('backend.inc.buttons.delete')
                                </div>
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
    <script>
        function deleteConfirm(formId){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to remove this Box?!",
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById(formId).submit()
                    Swal.fire('Deleted sucessfuly', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Canceld', '', 'info')
                }
            })
        }
    </script>
@endpush