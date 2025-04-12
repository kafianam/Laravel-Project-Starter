@extends('layouts.app')

@section('title', 'Edit Service')


@extends('layouts.app')
  
@section('title', 'Edit Service')
  
@section('contents')
    <h1 class="mb-0">Edit Product</h1>
    <hr />
    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="service_name" class="form-control" placeholder="service_name" value="{{ $service->service_name }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="fee" class="form-control" placeholder="Fee" value="{{ $service->fee }}" >
            </div>
        </div>
      
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection


