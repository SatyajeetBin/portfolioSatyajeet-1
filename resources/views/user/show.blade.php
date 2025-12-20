@extends('layouts.app')
@section('title', 'View User')
@section('styles')
    <style>
        h6 {
            margin: 10px;
        }

        label {
            margin-left: 8px;
        }

        .card-body hr {
            margin-top: 15px;
            border: 1px solid #D8D8DD
        }

        .border-right {
            border-right: 1px solid #D8D8DD;
        }

        .addButton {
            color: #fff !important;
            border-color: #fff;
        }

        .addButton:hover {
            color: #A27835 !important;
            background-color: #fff !important;
        }

        #maintenance_table td {
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 200px;
        }

        button.nav-link.waves-effect.waves-light {
            border: 1px solid #A27835 !important;
        }

        .nav-link {
            color: #A27835 !important;
        }

        button.active {
            color: #fff !important;
        }

        .nav-item {
            margin: 8px 10px 0 0 !important;
        }

        .responsive_hr {
            display: none;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 80px;
        }

        div.dataTables_wrapper div.col-sm-12 {
            padding: 0 !important;
        }

        .info-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            padding-bottom: 6.5px;
            /* Ensures uniform spacing */
        }

        .info-section h6 {
            margin-bottom: 10px;
            /* Spacing between title and label */
        }

        .info-section label {
            margin-top: 10px;
            /* Spacing between label and title */
        }

        @media screen and (max-width: 768px) {
            .table-responsive {
                overflow: scroll;
            }

            .border-right-md-none {
                border-right: none;
            }

            .border-right-md-block {
                border-right: 1px solid #D8D8DD;
            }
        }

        @media screen and (max-width: 425px) {
            .col-12 {
                display: flex;
            }

            .responsive_hr {
                display: block;
            }

            .border-right,
            .border-right-md-block {
                border: none;
            }

            .info-section {
                display: flex;
                flex-direction: row;
                justify-content: left;
                padding-bottom: 0px;
                align-items: anchor-center;
                /* Ensures uniform spacing */
            }

            .info-section label {
                margin-top: 0;
            }

            .mob-coloumn{
                flex-direction: column;
                align-items: normal;
            }
        }
    </style>
@endsection
@section('content')
    <div class="card mb-2">
        <div class="card-header d-md-flex d-sm-block align-items-center justify-content-between py-md-2">
            <h5 class="card-title m-0 me-2 text-secondary d-none d-md-block">View User Details</h5>
            <h3 class="card-title m-0 me-2 text-secondary d-block d-md-none">View User Details</h3>

            <div class="d-flex gap-2 mt-4 mt-md-0">
                <a href="{{ route('user.index') }}" class="btn btn-primary waves-effect waves-light addButton">Back</a>
                @php
                    $updateCheck = \App\Models\Permission::checkCRUDPermissionToUser('User', 'update');
                    if ($updateCheck) {
                        echo '<a href="' .
                            route('user.edit', $user->id) .
                            '" class="btn btn-primary waves-effect waves-light addButton">Update</a>';
                    }
                @endphp
            </div>
        </div>
        <div class="card-body py-2">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12 border-right">
                    <div class="info-section">
                        <h6>Full Name</h6>
                        <label>{{ $user->full_name }}</label>
                    </div>
                </div>
                <hr class="responsive_hr my-1">
                <div class="col-lg-3 col-md-4 col-12 border-right">
                    <div class="info-section">
                        <h6>Address</h6>
                        <label>{{ $user->address }}</label>
                    </div>
                </div>
                <hr class="responsive_hr my-1">
                <div class="col-lg-3 col-md-4 col-12 border-right border-right-md-none">
                    <div class="info-section">
                        <h6>Mobile</h6>
                        <label>{{ $user->contact }}</label>
                    </div>
                </div>
                <hr class="responsive_hr my-1">
                <hr class="my-1 d-none d-md-block d-lg-none">
                <div class="col-lg-3 col-md-4 col-12 border-right-md-block">
                    <div class="info-section">
                        <h6>Email</h6>
                        <label>{{ $user->email }}</label>
                    </div>
                </div>
                <hr class="my-1 d-block d-md-none d-lg-block">
                <div class="col-lg-3 col-md-4 col-12 border-right">
                    <div class="info-section">
                        <h6>Role</h6>
                        <label>{{ $user->role->name }}</label>
                    </div>
                </div>
                <hr class="responsive_hr my-1">
                @if ($user->role_id != 3)
                    <div class="col-lg-3 col-md-4 col-12 border-right border-right-md-none">
                        <div class="info-section">
                            <h6>Department</h6>
                            <label>{{ $user->department->name ?? '' }}</label>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3 col-md-4 col-12 border-right border-right-md-none">
                        <div class="info-section">
                            <h6>Event</h6>
                            <label>{{ $user->event ? $user->event->name : '' }}</label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if ($user->role_id == 3)
        <div class="row">
            <div class="col-xl-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-event" aria-controls="navs-pills-top-event"
                                aria-selected="true">
                                Event
                            </button>
                        </li>
                    </ul>
                    {{-- <hr> --}}
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-pills-top-event" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                                <table class="table" id="event_table">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Event Name</th>
                                            <th>Event Start Date</th>
                                            <th>Event End Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($events as $key => $event)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $event->name }}</td>
                                                <td>{{ date('d/m/Y H:i', strtotime($event->start_datetime)) }}</td>
                                                <td>{{ date('d/m/Y H:i', strtotime($event->end_datetime)) }}</td>
                                                <td>{{ $event->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#event_table').DataTable();
        });
    </script>
@endsection
