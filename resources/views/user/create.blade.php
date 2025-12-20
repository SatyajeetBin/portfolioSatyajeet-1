@extends('layouts.app')
@section('title', 'Create User')
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

        .parsley-errors-list {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
    </style>
@endsection
@section('content')
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h5 class="card-title m-0 me-2 text-secondary">Add User</h5>
        </div>
        <form action="{{ route('user.store') }}" method="post" id="userCreate" data-parsley-validate>
            @csrf
            <input autocomplete="off" type="hidden" name="page" value="modal">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <input autocomplete="off" type="text" class="form-control" name="name"
                                value="{{ old('name') }}" id="name" placeholder="Enter Name" required
                                data-parsley-required-message="The first name field is required." />
                            <label for="name">Name</label>
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
                                    <option value="{{ $role->id }}" @if (old('role_id') == $role->id) selected @endif>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                            <label for="role_id">Role</label>
                            <small class="red-text ml-10" id="role_err" role="alert">
                                @error('role_id')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <input autocomplete="off" type="tel" minlength="7" maxlength="12" class="form-control"
                                name="contact" value="{{ old('contact') }}" id="contact"
                                placeholder="Enter Contact" required
                                data-parsley-required-message="The contact field is required." data-parsley-type="digits"
                                data-parsley-pattern="^\d$" data-parsley-length="[7,12]"
                                data-parsley-pattern-message="Contact number must be between 7 to 12 digits." />
                            <label for="contact">Contact</label>
                            @error('contact')
                                <small class="red-text ml-10" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <input autocomplete="off" type="email" class="form-control" name="email"
                                value="{{ old('email') }}" id="email" placeholder="Enter Email" required
                                data-parsley-required-message="The email field is required." />
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
                                value="{{ old('address') }}" id="address" placeholder="Enter Address" required
                                data-parsley-required-message="The address field is required." />
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
                <button type="submit" class="btn btn-primary submitCreate">Save</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/parsley.min.js') }}"></script>
    <script>
        $('#userCreate').parsley();
        $(document).ready(function() {
            var role_id = "{{ old('role_id') }}";
            eventSection(role_id);

            $('#role_id').on('change', function() {
                var role_id = $(this).val();
                eventSection(role_id);
            });

            function eventSection(role_id) {
                if (role_id == 3) {
                    $('.department-section').addClass('d-none');
                    $('.event-section').removeClass('d-none');

                } else {
                    $('.event-section').addClass('d-none');
                    $('.department-section').removeClass('d-none');
                }
            }

            submitUserForm();
        });

        function submitUserForm() {
            $('#userCreate').off('submit').on('submit', function(e) {
                $('.submitCreate').prop('disabled', true);
                e.preventDefault();
                $('.error').remove();
                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.errors) {
                            $('.submitCreate').prop('disabled', false);
                            $.each(response.errors, function(key, value) {
                                $('#' + key).after(
                                    '<span class="error" style="position: absolute; z-index: 9; top: 45px;">' +
                                    value + '</span>');
                            });
                        } else {
                            window.location.href = '{{ route('user.index') }}'
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status, error);
                    }
                });
            });
        }
    </script>
@endsection
