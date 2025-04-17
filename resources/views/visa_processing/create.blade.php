@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection


@section('title', 'Applicant Details')

@section('content_header')
    <h1>Applicant Details</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('visa_processing.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                    <label for="service_id">Service</label>
                    <select name="service_id" id="service_id" class="form-control">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->service_name }} - {{ $service->fee }} TK</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4">
                       
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <x-adminlte-input name="name" label="Full Name as Passport" placeholder="Enter full name" required />
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input name="passport_number" label="Passport Number" placeholder="Enter passport number" required />
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-select name="nationality" label="Nationality">
                            <option>Select Country</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="India">India</option>
                            <!-- Add more countries -->
                        </x-adminlte-select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-adminlte-select name="travel_from" label="Travel From">
                            <option>Select Country</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="India">India</option>
                            <!-- Add more countries -->
                        </x-adminlte-select>
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-select name="travel_type" label="Travel Type/Purpose">
                            <option value="">- Select -</option>
                            <option value="Business">Business</option>
                            <option value="Tourism">Tourism</option>
                        </x-adminlte-select>
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input name="expected_travel_date" label="Expected Travel Date" type="date" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-adminlte-input name="primary_contact" label="Primary Contact No" />
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input name="emergency_contact" label="Emergency Contact No" />
                    </div>
                    <div class="col-md-4">
                        <x-adminlte-input name="email" label="Email Address" type="email" />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <x-adminlte-input name="passport_copy" label="Passport Copy" type="file" />
                    </div>
                    <div class="col-md-3">
                        <x-adminlte-input name="ticket_copy" label="Ticket Copy" type="file" />
                    </div>
                    <div class="col-md-3">
                        <x-adminlte-input name="hotel_booking" label="Hotel Booking" type="file" />
                    </div>
                    <div class="col-md-3">
                        <x-adminlte-input name="other_doc" label="Others Doc" type="file" />
                    </div>
                </div>

                <div class="mt-4">
                    <label><strong>Advance Purchase <span class="text-danger">*</span></strong></label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="advance_purchase[]" value="Hotel Accommodation">
                        <label class="form-check-label">Hotel Accommodation</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="advance_purchase[]" value="Tickets & Transfer">
                        <label class="form-check-label">Tickets & Transfer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="advance_purchase[]" value="Tour Packages">
                        <label class="form-check-label">Tour Packages</label>
                    </div>
                </div>

                <div class="mt-4">
                    <x-adminlte-button class="btn-primary" type="submit" label="Submit Form" />
                </div>
            </form>
        </div>
    </div>
@stop

