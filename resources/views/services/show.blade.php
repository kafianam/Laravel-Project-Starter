

@extends('layouts.app')
  
@section('title', 'Show Services')
  
@section('contents')
    <h1 class="mb-0">Detail Service</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">service</label>
            <input type="text" name="service_name" class="form-control" placeholder="Service Name" value="{{ $service->service_name}}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Fee</label>
            <input type="text" name="fee" class="form-control" placeholder="Fee" value="{{ $service->fee }}" readonly>
        </div>
    </div>
    
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $product->updated_at }}" readonly>
        </div>
    </div>
@endsection