@extends('layouts.app')
@section('title', 'Role Details View')

@section('styles')
    <style>
        .addButton {
            color: #fff !important;
            border-color: #fff;
        }

        .addButton:hover {
            color: #f13737 !important;
            background-color: #fff !important;
        }

        @media screen and (max-width: 425px) {
            .table-responsive {
                overflow-x: scroll !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-md-flex d-sm-block align-items-center justify-content-between py-md-2">
                    <h5 class="card-title m-0 me-2 text-secondary d-none d-md-block">View Role Details</h5>
                    <h3 class="card-title m-0 me-2 text-secondary d-block d-md-none">View Role Details</h3>

                    <div class="d-flex gap-2 mt-4 mt-md-0">
                        <a href="{{ route('role.index') }}"
                            class="btn btn-primary waves-effect waves-light addButton">Back</a>
                        <a href="{{ route('role.edit', $role->id) }}"
                            class="btn btn-primary waves-effect waves-light addButton">Update</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('role.update', $role->id) }}">
                        @csrf
                        <div class="row">
                             <input autocomplete="off" type="hidden" name="id" value="{{ $role->id }}">

                            <div class="form-floating form-floating-outline mb-4">
                                 <input autocomplete="off" type="text" class="form-control" name="role" id="role"
                                    value="{{ $role->name }}" required readonly />
                                <label for="role">Role</label>
                                @error('role')
                                    <small class="red-text ml-10" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="input-field col-sm-12">
                                <div class="card">
                                    <h5 class="card-header text-secondary py-3">Permission Table</h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Module Permission</th>
                                                    <th>Create</th>
                                                    <th>Read</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($accessData as $key => $value)
                                                    @php
                                                        $data = $permissionData
                                                            ->where('module', $value)
                                                            ->where('role_id', $role->id)
                                                            ->first();
                                                        if (!empty($data)) {
                                                            $create = $data['create'] == 'on' ? 'checked' : '';
                                                            $read = $data['read'] == 'on' ? 'checked' : '';
                                                            $update = $data['update'] == 'on' ? 'checked' : '';
                                                            $delete = $data['delete'] == 'on' ? 'checked' : '';
                                                        }
                                                    @endphp
                                                    @if (!empty($data) && $data['module'] == $value)
                                                        <tr>
                                                            <td>{{ $value }}</td>
                                                            <td>
                                                                <label class="form-check">
                                                                     <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][create]"
                                                                        {{ $create }} disabled />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                     <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][read]"
                                                                        {{ $read }} disabled />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                     <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][update]"
                                                                        {{ $update }} disabled />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                     <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][delete]"
                                                                        {{ $delete }} disabled />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>{{ $value }}</td>
                                                            <td>
                                                                <label class="form-check">
                                                                     <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][create]"
                                                                        disabled />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                     <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][read]"
                                                                        disabled />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                     <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][update]"
                                                                        disabled />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="form-check">
                                                                     <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                        name="permission[{{ $key }}][delete]"
                                                                        disabled />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('form').parsley();
    </script>
@endsection
