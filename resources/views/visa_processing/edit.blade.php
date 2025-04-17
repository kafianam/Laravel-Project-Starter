@extends('adminlte::page')

@section('title', 'Edit Visa Processing Form')

@section('content_header')
    <h1>Edit Visa Processing Form</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('visa_processing.update', $visaProcessingForm->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="service_id">Service</label>
                    <select name="service_id" id="service_id" class="form-control">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ $visaProcessingForm->service_id == $service->id ? 'selected' : '' }}>
                                {{ $service->service_name }} - {{ $service->fee }} TK
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="passport_number">Passport Number</label>
                    <input type="text" class="form-control" id="passport_number" name="passport_number" value="{{ $visaProcessingForm->passport_number }}" required>
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $visaProcessingForm->name }}" required>
                </div>

                <!-- Add the rest of the fields similarly as in the create form -->

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@stop
