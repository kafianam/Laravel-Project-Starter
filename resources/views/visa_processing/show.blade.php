@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('title', 'Visa Processing Form Details')

@section('content_header')
    <h1>LOI Processing Form Details</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <p><strong>Service:</strong> 
    {{ $visaProcessingForm->service->service_name }} - {{ $visaProcessingForm->service->fee }} TK
            </p>

            <p><strong>Name:</strong> {{ $visaProcessingForm->name }}</p>
            <p><strong>Passport Number:</strong> {{ $visaProcessingForm->passport_number }}</p>
            <p><strong>Nationality:</strong> {{ $visaProcessingForm->nationality }}</p>
            <p><strong>Travel From:</strong> {{ $visaProcessingForm->travel_from }}</p>
            <p><strong>Travel Type:</strong> {{ $visaProcessingForm->travel_type }}</p>
            <p><strong>Expected Travel Date:</strong> {{ $visaProcessingForm->expected_travel_date }}</p>
            <p><strong>Primary Contact:</strong> {{ $visaProcessingForm->primary_contact }}</p>
            <p><strong>Emergency Contact:</strong> {{ $visaProcessingForm->emergency_contact }}</p>
            <p><strong>Email:</strong> {{ $visaProcessingForm->email }}</p>

            @if($visaProcessingForm->passport_copy)
                <p><strong>Passport Copy:</strong> <a href="{{ asset('storage/' . $visaProcessingForm->passport_copy) }}" target="_blank">View Passport Copy</a></p>
            @else
                <p><strong>Passport Copy:</strong> Not provided</p>
            @endif

            @if($visaProcessingForm->ticket_copy)
                <p><strong>Ticket Copy:</strong> <a href="{{ asset('storage/' . $visaProcessingForm->ticket_copy) }}" target="_blank">View Ticket Copy</a></p>
            @else
                <p><strong>Ticket Copy:</strong> Not provided</p>
            @endif

            @if($visaProcessingForm->hotel_booking)
                <p><strong>Hotel Booking:</strong> <a href="{{ asset('storage/' . $visaProcessingForm->hotel_booking) }}" target="_blank">View Hotel Booking</a></p>
            @else
                <p><strong>Hotel Booking:</strong> Not provided</p>
            @endif

            @if($visaProcessingForm->other_doc)
                <p><strong>Other Document:</strong> <a href="{{ asset('storage/' . $visaProcessingForm->other_doc) }}" target="_blank">View Other Document</a></p>
            @else
                <p><strong>Other Document:</strong> Not provided</p>
            @endif

           
            <p><strong>Advance Purchase:</strong>
    {{ is_array($visaProcessingForm->advance_purchase) ? implode(', ', $visaProcessingForm->advance_purchase) : 'Not provided' }}
</p>
            <p><strong>Application Status:</strong> {{ $visaProcessingForm->application_status }}</p>
            <p><strong>Payment Status:</strong> {{ $visaProcessingForm->payment_status }}</p>
            <p><strong>Payment Method:</strong> {{ $visaProcessingForm->payment_method }}</p>
            <p><strong>Payment Date:</strong> {{ $visaProcessingForm->payment_date }}</p>

            <a href="{{ route('visa_processing.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('visa_processing.print', $visaProcessingForm->id) }}" target="_blank" class="btn btn-primary">
    <i class="fas fa-print"></i> Print Voucher
</a>

        </div>
    </div>
@stop
