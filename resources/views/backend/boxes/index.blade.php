@extends('layouts.backend.master')

@section('title', $title)

@push('add_css')
    <style>
        #table{{ lcfirst($pluralModelName) }} {
            position: relative;
        }
        #loader {
            position: absolute;
            right: 0;
            left: 0;
            text-align: center;
            top: calc(50% - 75px);
            display: none;
        }
        #loader img {
            width: 150px;
            height: 150px;
        }
    </style>
@endpush

@section('content')
    <div class="col-md-8 col-lg-9">
        <x-table-card-components :title="$title" :slogan="$slogan" :pluralModelName="$pluralModelName" :items="$items">
            @include('backend.'.lcfirst($pluralModelName).'.table')
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

                $("#table{{ lcfirst($pluralModelName) }}").css('opacity', '0.6');
                $("#loader").show();

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
                $("#loader").hide();
                $("#table{{ lcfirst($pluralModelName) }}").css('opacity', '1');
                $("#table{{ lcfirst($pluralModelName) }}").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError){
                alert('No response from server');
            });
        }
    </script>
@endpush