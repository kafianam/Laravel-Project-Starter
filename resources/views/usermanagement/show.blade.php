@extends('adminlte::page')

@section('title', 'User Details')

@section('content_header')
    <h1>User Details</h1>
@stop

@section('content')
    <div class="card p-3">
        <table class="table table-bordered">
            <tr>
                <th>Name:</th>
                <td>{{ $usermanagement->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $usermanagement->email }}</td>
            </tr>
            <tr>
                <th>Role:</th>
                <td>{{ $usermanagement->role }}</td>
            </tr>
        </table>
        <a href="{{ route('usermanagement.index') }}" class="btn btn-primary mt-3">Back to List</a>
    </div>
@stop
