@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    <div class="card p-3">
        <form action="{{ route('usermanagement.update', $usermanagement->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $usermanagement->name) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $usermanagement->email) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="role">Role:</label>
                <input type="text" class="form-control" name="role" value="{{ old('role', $usermanagement->role) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('usermanagement.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@stop
