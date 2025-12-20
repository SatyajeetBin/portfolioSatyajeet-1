@extends('layouts.app')
@section('title', 'Update Role')

@section('styles')
    <style>
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
                <div class="card-header d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 page-header-title text-secondary">Role Update</h5>
                </div>
                <form method="POST" enctype="multipart/form-data" action="{{ route('role.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                             <input autocomplete="off" type="hidden" name="id" value="{{ $role->id }}">

                            <div class="form-floating form-floating-outline mb-4">
                                 <input autocomplete="off" type="text" class="form-control" name="name" id="name"
                                    value="{{ $role->name }}" placeholder="name" required />
                                <label for="name">Role</label>
                                @error('name')
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
                                                                @if ($value == 'Activity Log')
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][create]"
                                                                            {{ $create }} disabled />
                                                                        <span></span>
                                                                    </label>
                                                                @else
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][create]"
                                                                            {{ $create }} />
                                                                        <span></span>
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (
                                                                    $value == 'event-check-in' ||
                                                                        $value == 'user-status' ||
                                                                        $value == 'user-reset-password' ||
                                                                        $value == 'donation-email-pdf' ||
                                                                        $value == 'donation-whatsapp-pdf' ||
                                                                        $value == 'resend-membership pack' ||
                                                                        $value == 'make-life-member')
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][read]"
                                                                            {{ $read }} disabled />
                                                                        <span></span>
                                                                    </label>
                                                                @else
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][read]"
                                                                            {{ $read }} />
                                                                        <span></span>
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (
                                                                    $value == 'event-check-in' ||
                                                                        $value == 'user-status' ||
                                                                        $value == 'user-reset-password' ||
                                                                        $value == 'donation-email-pdf' ||
                                                                        $value == 'donation-whatsapp-pdf' ||
                                                                        $value == 'resend-membership pack' ||
                                                                        $value == 'make-life-member' ||
                                                                        $value == 'Activity Log')
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][update]"
                                                                            {{ $update }} disabled />
                                                                        <span></span>
                                                                    </label>
                                                                @else
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][update]"
                                                                            {{ $update }} />
                                                                        <span></span>
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (
                                                                    $value == 'event-check-in' ||
                                                                        $value == 'user-status' ||
                                                                        $value == 'user-reset-password' ||
                                                                        $value == 'donation-email-pdf' ||
                                                                        $value == 'donation-whatsapp-pdf' ||
                                                                        $value == 'resend-membership pack' ||
                                                                        $value == 'make-life-member' ||
                                                                        $value == 'Activity Log')
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][delete]"
                                                                            {{ $delete }} disabled />
                                                                        <span></span>
                                                                    </label>
                                                                @else
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][delete]"
                                                                            {{ $delete }} />
                                                                        <span></span>
                                                                    </label>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>{{ $value }}</td>
                                                            <td>
                                                                @if ($value == 'Activity Log')
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][create]"
                                                                            disabled />
                                                                        <span></span>
                                                                    </label>
                                                                @else
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][create]" />
                                                                        <span></span>
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (
                                                                    $value == 'event-check-in' ||
                                                                        $value == 'user-status' ||
                                                                        $value == 'user-reset-password' ||
                                                                        $value == 'donation-email-pdf' ||
                                                                        $value == 'donation-whatsapp-pdf' ||
                                                                        $value == 'resend-membership pack' ||
                                                                        $value == 'make-life-member')
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][read]"
                                                                            disabled />
                                                                        <span></span>
                                                                    </label>
                                                                @else
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][read]" />
                                                                        <span></span>
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (
                                                                    $value == 'event-check-in' ||
                                                                        $value == 'user-status' ||
                                                                        $value == 'user-reset-password' ||
                                                                        $value == 'donation-email-pdf' ||
                                                                        $value == 'donation-whatsapp-pdf' ||
                                                                        $value == 'resend-membership pack' ||
                                                                        $value == 'make-life-member' ||
                                                                        $value == 'Activity Log')
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][update]"
                                                                            disabled />
                                                                        <span></span>
                                                                    </label>
                                                                @else
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][update]" />
                                                                        <span></span>
                                                                    </label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (
                                                                    $value == 'event-check-in' ||
                                                                        $value == 'user-status' ||
                                                                        $value == 'user-reset-password' ||
                                                                        $value == 'donation-email-pdf' ||
                                                                        $value == 'donation-whatsapp-pdf' ||
                                                                        $value == 'resend-membership pack' ||
                                                                        $value == 'make-life-member' ||
                                                                        $value == 'Activity Log')
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][delete]"
                                                                            disabled />
                                                                        <span></span>
                                                                    </label>
                                                                @else
                                                                    <label class="form-check">
                                                                         <input autocomplete="off" class="form-check-input" type="checkbox"
                                                                            name="permission[{{ $key }}][delete]" />
                                                                        <span></span>
                                                                    </label>
                                                                @endif
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
                    </div>
                    <div class="card-footer text-end pt-0">
                        <a href="{{ route('role.index') }}"
                            class="btn btn-outline-secondary waves-effect waves-light me-1">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
