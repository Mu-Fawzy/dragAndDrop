@extends('layouts.backend.master')

@section('title', $title)

@push('add_css')
    
@endpush

@section('content')
    <div class="col-md-9">
        <x-table-card-components :title="$title" :slogan="$slogan" :pluralModelName="$pluralModelName">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">اسم صندوق المهام</th>
                        <th scope="col">تاريخ الانشاء</th>
                        <th scope="col">العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="d-flex justify-content-right">
                                    @include('backend.inc.buttons.edit')
                                    @include('backend.inc.buttons.delete')
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">{{ $nothingHere }}</td>
                        </tr>
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
                title: 'هل انت متأكد ؟',
                text: "تريد إزالة هذا الصندوق!",
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `نعم`,
                denyButtonText: `لا`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                    Swal.fire({
                        title: 'تم الحذف بنجاح',
                        icon: 'success',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: `نعم`,
                    })
                } else if (result.isDenied) {
                    Swal.fire({
                        title: 'تم الالغاء',
                        icon: 'info',
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: `نعم`,
                    })
                }
            })
        }
    </script>
@endpush