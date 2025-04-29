@extends('adminlte::page')

@section('title', 'Edit Service')

@section('content_header')
    <h1>Edit Service</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')
    <div class="card p-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Please fix the following issues:<br><br>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="service_name">Service Name</label>
                <input type="text" name="service_name" id="service_name" class="form-control" value="{{ $service->service_name }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="fee">Fee (Tk)</label>
                <input type="number" name="fee" id="fee" class="form-control" value="{{ $service->fee }}" required>
            </div>

            <div class="text-end">
                <a href="{{ route('services.index') }}" class="btn btn-secondary me-2">Back</a>
                <button type="submit" class="btn btn-warning">Update Service</button>
            </div>
        </form>
    </div>
@stop
