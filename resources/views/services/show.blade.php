@extends('adminlte::page')

@section('title', 'Service Details')

@section('content_header')
    <h1>Service Details</h1>
@stop

@section('content')
    <div class="card p-4">
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Service Name</label>
                <input type="text" class="form-control" value="{{ $service->service_name }}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Fee (Tk)</label>
                <input type="text" class="form-control" value="{{ $service->fee }}" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Created At</label>
                <input type="text" class="form-control" value="{{ $service->created_at->format('Y-m-d H:i') }}" readonly>
            </div>
            <div class="col">
                <label class="form-label">Updated At</label>
                <input type="text" class="form-control" value="{{ $service->updated_at->format('Y-m-d H:i') }}" readonly>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@stop
