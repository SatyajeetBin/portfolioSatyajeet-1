@extends('layouts.app')
@section('title', 'Update User')
@section('styles')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h5 class="card-title m-0 me-2 text-secondary">Update User</h5>
        </div>
        <form action="{{ route('user.update', $user->id) }}" method="post" id="user_form" data-parsley-validate>
            @csrf
            @method('PUT')
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <input autocomplete="off" type="text" class="form-control" name="name"
                                value="{{ old('name', $user->name) }}" id="name"
                                placeholder="Enter Name" required
                                data-parsley-required-message="The name field is required."/>
                            <label for="name">First Name</label>
                            @error('name')
                                <small class="red-text ml-10" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select select2" id="role_id" name="role_id"
                                aria-label="Default select example" data-placeholder="Select Role" required
                                data-parsley-required-message="The role field is required."
                                data-parsley-errors-container="#role_err">
                                <option value="" selected>Select Role</option>
                                @foreach ($roles as $role)
                                    <option @if (old('role_id', $user->role_id) == $role->id) selected @endif value="{{ $role->id }}">
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                            <label for="role_id">Role</label>
                            @error('role_id')
                                <small class="red-text ml-10" id="role_err" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <input autocomplete="off" type="tel" minlength="7" maxlength="12" class="form-control"
                                name="contact" pattern="^\d{7,12}$" value="{{ old('contact', $user->contact) }}"
                                id="contact" placeholder="Enter Contact" required
                                data-parsley-required-message="The contact field is required."
                                data-parsley-pattern="^\d{7,12}$"
                                data-parsley-pattern-message="Contact number must be between 7 to 12 digits."/>
                            <label for="contact">Contact</label>
                            @error('contact')
                                <small class="red-text ml-10" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="form-floating form-floating-outline">
                            <input autocomplete="off" type="email" class="form-control" name="email" id="email"
                                value="{{ old('email', $user->email) }}" placeholder="Enter Email" required
                                data-parsley-required-message="The email field is required."/>
                            <label for="email">Email</label>
                            @error('email')
                                <small class="red-text ml-10" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <input autocomplete="off" type="text" class="form-control" name="address"
                                value="{{ old('address', $user->address) }}" id="address"
                                placeholder="Enter Address Line 1" required
                                data-parsley-required-message="The address field is required."/>
                            <label for="address">Address</label>
                            @error('address')
                                <small class="red-text ml-10" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card-footer text-end pt-0">
                <a href="{{ route('user.index') }}"
                    class="btn btn-outline-secondary waves-effect waves-light me-1">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script>
        $('#user_form').parsley();
        $(document).ready(function() {
            if ($('#contact').val() != '') {
                $('#contact').attr('disabled', true);
            }
            if ($('#email').val() != '') {
                $('#email').attr('disabled', true);
            }

            $('#user_form').on('submit', function() {
                $('#contact').attr('disabled', false);
                $('#email').attr('disabled', false);
            });

        });
    </script>
@endsection
