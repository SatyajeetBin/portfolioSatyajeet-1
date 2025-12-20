@extends('layouts.app')
@section('title', 'Create Role')
@section('styles')
@endsection
@section('content')
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between py-3">
            <h5 class="card-title m-0 me-2 text-secondary">Add Role</h5>
        </div>
        <form action="{{ route('role.store') }}" method="post">
            @csrf
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                             <input autocomplete="off" type="text" class="form-control" name="name" id="name"
                                value="{{ old('name') }}" placeholder="Enter Role" />
                            <label for="name">Role</label>
                            @error('name')
                                <small class="red-text ml-10" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('role.index') }}"
                    class="btn btn-outline-secondary waves-effect waves-light me-1">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
@endsection
