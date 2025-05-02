@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
    <h1>Add User</h1>
@stop

@section('content')
    <div class="card p-3">
        <form action="{{ route('usermanagement.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>

             <div class="form-group">
                <select name="role" class="form-control form-control-user @error('role')is-invalid @enderror" id="exampleInputName">
                  <option value="customer">customer</option>
                  <option value="agent">Agent</option>
                </select>                  
                </div>
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('usermanagement.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@stop
