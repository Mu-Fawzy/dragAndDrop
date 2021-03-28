@extends('layouts.backend.app')
@push('add_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        body {
            background-color: #f9f9fa;
        }
        a:focus,
        a:hover {
            text-decoration: none;
        }
    
        .teamcard {
            border-width: 0;
            border-radius: 0.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            word-wrap: break-word;
            background-color: #fff;
            border: 1px solid rgba(19, 24, 44, 0.125);
            border-radius: 0.25rem;
        }
    
        .list-item {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
        }
    
        .list-item.block .media {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
    
        .flex {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
        }
    
        .userinfo {
            height: 1.25rem;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            font-size: 12px;
        }
    
        .list-row .list-item {
            -ms-flex-direction: row;
            flex-direction: row;
            -ms-flex-align: center;
            align-items: center;
        }
    
        .list-item {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
        }
    
        .list-row .list-item > * {
            padding-left: 0.625rem;
            padding-right: 0.625rem;
        }
    
        .grid-trash {
            margin-top: 20px;
            width: 700px;
            background-color: #f5f2f2;
            color: #999;
            padding: 10px;
            height: 150px;
            padding: 10px;
            border: 2px dashed #999;
            text-align: center;
        }
        .grid-trash-hover {
            background-color: #f34541;
            color: #fff;
            border: 2px dashed #fff;
        }
        .drag-location {
            border: 2px dashed #999;
            background: #ede8e8;
        }  
    </style>
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as admin!') }}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Drag & Drop') }}</div>

                <div class="card-body">
                    
                    {{--  {
                        id: 1,
                        name: "Id.",
                        order: 19,
                        items: [
                        {
                        id: 1,
                        name: "Accusamus tempore aut nihil.",
                        order: 15,
                        box_id: 1
                        },
                    }      --}}
                    
                    <div class="dropzone-teams card-body">
                        <div class="drag-team">
                            <!-- TEAM A -->
                            <div class="row teamcard my-2 mx-2 pt-2 pb-1">
                                <div class="col-md-4 my-auto text-center" style="font-weight: bold; font-size: 18px;">
                                    <div class="row">
                                        <div class="col-md-1"><i class="team-handle fas fa-ellipsis-v" style="cursor:ns-resize;"></i></div>
                                        <div class="col-md-9">TEAM A</div>
                                    </div>
                                </div>
                                <div class="col-md-8 dropzone-users">
                                    <!-- USER 1 -->
                                    <div class="drag-user list list-row bg-white">
                                        <div class="list-item border mb-1">
                                            <div class="text-muted" style="cursor:ns-resize; padding-right: 0!important"><i class="user-handle fas fa-ellipsis-v"></i></div>
                                            <div class="flex">
                                                Linod Patrick
                                                <div class="item-except text-muted text-sm userinfo">Has appointment at 15:00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="drag-team">
                            <!-- TEAM B -->
                            <div class="row teamcard my-2 mx-2 pt-2 pb-1">
                            <div class="col-md-4 my-auto text-center" style="font-weight: bold; font-size: 18px;">
                                <div class="row">
                                <div class="col-md-1"><i class="team-handle fas fa-ellipsis-v" style="cursor:ns-resize;"></i></div>
                                <div class="col-md-9">TEAM B</div>
                                </div>
                            </div>
                            <div class="col-md-8 dropzone-users">
                                <!-- USER 3 -->
                                <div class="drag-user list list-row bg-white">
                                <div class="list-item border mb-1">
                                    <div class="text-muted" style="cursor:ns-resize; padding-right: 0!important"><i class="user-handle fas fa-ellipsis-v"></i></div>
                                    <div class="flex">Verwije Romme <div class="item-except text-muted text-sm userinfo"></div>
                                    </div>
                                    <div class="no-wrap">
                                    <div class="dropdown">
                                        <a class="text-muted" href="#" id="user3" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-cog"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="user3">
                                        <a class="dropdown-item" href="#" data-abc="true">See detail</a>
                                        <a class="dropdown-item" data-abc="true">Download</a>
                                        <a class="dropdown-item" data-abc="true">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-abc="true">Delete item</a>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!-- USER 4 -->
                                <div class="drag-user list list-row bg-white">
                                <div class="list-item border mb-1">
                                    <div class="text-muted" style="cursor:ns-resize; padding-right: 0!important"><i class="user-handle fas fa-ellipsis-v"></i></div>
                                    <div class="flex">Mak Lokman<div class="item-except text-muted text-sm userinfo">shift starts at 11:00</div>
                                    </div>
                                    <div class="no-wrap">
                                    <div class="dropdown">
                                        <a class="text-muted" href="#" id="user4" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-cog"></i></a>
                                        <ul class="dropdown-menu" aria-labelledby="user4">
                                        <a class="dropdown-item" href="#" data-abc="true">See detail</a>
                                        <a class="dropdown-item" data-abc="true">Download</a>
                                        <a class="dropdown-item" data-abc="true">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-abc="true">Delete item</a>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div> <!-- DROPZONE END -->
                        
                    <div class="container">
                        <div class="row justify-content-center align-items-center">
                            <div id="trash" class="grid-trash">
                            Drag a <b>team</b> or <b>user</b> here to delete it
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('add_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script>
        // SORT TEAMS
        $(".dropzone-teams").sortable({
            placeholder: "drag-location",
            handle: ".team-handle",
            start: function (e, ui) {
            ui.placeholder.height(ui.helper.outerHeight());
            }
        });
        
        // SORT USERS
        $(".dropzone-users").sortable({
            connectWith: ".dropzone-users",
            handle: ".user-handle",
            placeholder: "drag-location",
            start: function (e, ui) {
            ui.placeholder.height(ui.helper.outerHeight());
            }
        });
        
        // TRASH TEAM AND/OR USER
        $("#trash").droppable({
            accept: ".drag-team, .drag-user",
            hoverClass: "grid-trash-hover ",
            drop: function (event, ui) {
            ui.draggable.remove();
            }
        });
    </script>
@endpush
