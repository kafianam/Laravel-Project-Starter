
@extends('layouts.app')
  
@section('title', 'Create Service')
  
@section('contents')
    <h1 class="mb-0">Add Service</h1>
    <hr />
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="service_name" class="form-control" placeholder="Serice name">
            </div>
            <div class="col">
                <input type="text" name="fee" class="form-control" placeholder="Fee">
            </div>
        </div>
        
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection

@section('content')
    <h2>Add New Visa Service</h2>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Service Name</label>
            <input type="text" name="service_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Fee (Tk)</label>
            <input type="number" name="fee" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Service</button>
    </form>
@endsection
