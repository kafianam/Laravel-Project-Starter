@extends('adminlte::page')
@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection
@section('title', 'Edit Visa Processing Form')


@section('content_header')
    <h1>Edit LOI Processing Form</h1>
@stop

@php
    $user = auth()->user();
@endphp

@section('content')
    <div class="card">
        <div class="card-body">
        <form action="{{ route('visa_processing.update', $visaProcessingForm->id) }}" method="POST" enctype="multipart/form-data">

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

                <div class="form-group"><label for="name">Full Name</label><input type="text" class="form-control" id="name" name="name" value="{{ $visaProcessingForm->name }}"></div>
                <div class="form-group"><label for="passport_number">Passport Number</label><input type="text" class="form-control" id="passport_number" name="passport_number" value="{{ $visaProcessingForm->passport_number }}"></div>
                <div class="form-group"><label for="nationality">Nationality</label><input type="text" class="form-control" id="nationality" name="nationality" value="{{ $visaProcessingForm->nationality }}"></div>
                <div class="form-group"><label for="travel_from">Travel From</label><input type="text" class="form-control" id="travel_from" name="travel_from" value="{{ $visaProcessingForm->travel_from }}"></div>
                <div class="form-group"><label for="travel_type">Travel Type</label><input type="text" class="form-control" id="travel_type" name="travel_type" value="{{ $visaProcessingForm->travel_type }}"></div>
                <div class="form-group"><label for="expected_travel_date">Expected Travel Date</label><input type="date" class="form-control" id="expected_travel_date" name="expected_travel_date" value="{{ $visaProcessingForm->expected_travel_date }}"></div>
                <div class="form-group"><label for="primary_contact">Primary Contact</label><input type="text" class="form-control" id="primary_contact" name="primary_contact" value="{{ $visaProcessingForm->primary_contact }}"></div>
                <div class="form-group"><label for="emergency_contact">Emergency Contact</label><input type="text" class="form-control" id="emergency_contact" name="emergency_contact" value="{{ $visaProcessingForm->emergency_contact }}"></div>
              
                <div class="form-group">
                    <label for="passport_copy">Passport Copy</label>
                    <input type="file" class="form-control" id="passport_copy" name="passport_copy">
                    @if($visaProcessingForm->passport_copy)
                        <a href="{{ asset('storage/' . $visaProcessingForm->passport_copy) }}" target="_blank">View Current File</a>
                    @endif
                </div>

                <div class="form-group">
                    <label for="ticket_copy">Ticket Copy</label>
                    <input type="file" class="form-control" id="ticket_copy" name="ticket_copy">
                    @if($visaProcessingForm->ticket_copy)
                        <a href="{{ asset('storage/' . $visaProcessingForm->ticket_copy) }}" target="_blank">View Current File</a>
                    @endif
                </div>

                <div class="form-group">
                    <label for="hotel_booking">Hotel Booking</label>
                    <input type="file" class="form-control" id="hotel_booking" name="hotel_booking">
                    @if($visaProcessingForm->hotel_booking)
                        <a href="{{ asset('storage/' . $visaProcessingForm->hotel_booking) }}" target="_blank">View Current File</a>
                    @endif
                </div>

                <div class="form-group">
                    <label for="other_doc">Other Document</label>
                    <input type="file" class="form-control" id="other_doc" name="other_doc">
                    @if($visaProcessingForm->other_doc)
                        <a href="{{ asset('storage/' . $visaProcessingForm->other_doc) }}" target="_blank">View Current File</a>
                    @endif
                </div>

                                {{-- Advance Purchase --}}
                                @php
    $advancePurchaseOptions = ['Hotel Accommodation', 'Tickets & Transfer', 'Tour Packages'];
@endphp

<div class="form-group mt-4">
    <label><strong>Advance Purchase <span class="text-danger">*</span></strong></label>
    @foreach($advancePurchaseOptions as $item)
        <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                name="advance_purchase[]"
                value="{{ $item }}"
                {{ in_array($item, $advancePurchases ?? []) ? 'checked' : '' }}
            >
            <label class="form-check-label">{{ $item }}</label>
        </div>
    @endforeach
</div>



                {{-- Application Status --}}
                @if($user->role === 'admin')
                    <div class="form-group">
                        <label for="application_status">Application Status</label>
                        <select class="form-control" name="application_status" id="application_status">
                            @foreach(['Pending', 'Processing', 'On Hold', 'Approved', 'Cancel', 'Reject'] as $status)
                                <option value="{{ $status }}" {{ $visaProcessingForm->application_status == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Payment Status --}}
                @if($user->role === 'admin')
                    <div class="form-group">
                        <label for="payment_status">Payment Status</label>
                        <select class="form-control" name="payment_status" id="payment_status">
                            <option value="Paid" {{ $visaProcessingForm->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Unpaid" {{ $visaProcessingForm->payment_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </div>
                @endif

                {{-- Payment Method --}}
                @if($user->role === 'admin')
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select class="form-control" name="payment_method" id="payment_method">
                            @foreach(['Cash', 'Bkash', 'Rocket', 'Nagod', 'Cheque', 'Online Bank Transfer'] as $method)
                                <option value="{{ $method }}" {{ $visaProcessingForm->payment_method == $method ? 'selected' : '' }}>
                                    {{ $method }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Payment Date --}}
                @if($user->role === 'admin')
                    <div class="form-group">
                        <label for="payment_date">Payment Date</label>
                        <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ $visaProcessingForm->payment_date }}">
                    </div>
                @endif


                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>

            </form>
        </div>
    </div>
@stop
