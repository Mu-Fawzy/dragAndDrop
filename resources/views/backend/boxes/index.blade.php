@extends('layouts.backend.master')

@section('title', $title)

@push('add_css')
    
@endpush

@section('content')
    <div class="col-md-8 col-lg-9">
        <x-table-card-components :title="$title" :slogan="$slogan" :pluralModelName="$pluralModelName" :items="$items">
            @include('backend.boxes.table')
        </x-table-card-components>
        
    </div>
@endsection

@push('add_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

        // load paginate ajax
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getData(page);
                }
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.pagination a',function(event){
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var page = $(this).attr('href').split('page=')[1];

                getData(page)
            })
        });

        function getData(page) {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(data){
                $("#tableboxes").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError){
                alert('No response from server');
            });
        }
    </script>
@endpush