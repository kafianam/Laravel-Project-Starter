<!DOCTYPE html>
<html>
<head>
    <title>Visa Application PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; }
        .doc-img { width: 200px; height: auto; margin-top: 10px; }

        .logo { text-align: center; margin-bottom: 10px; }
        .title { text-align: center; font-size: 18px; font-weight: bold; text-decoration: underline; }
        .name-info { text-align: left; font-size: 16px; margin-bottom: 15px; text-decoration: underline;}

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <div class="logo">
        <img src="{{ public_path('images/logo.png') }}" height="100" alt="Company Logo">
    </div>

    <div class="title">TOUR ITINERARY</div>
    <div class="name-info">
        {{ strtoupper($visaProcessingForm->name) }} - {{ $visaProcessingForm->passport_number }}
    </div>

    @if(is_array($visaProcessingForm->itineraries) && count($visaProcessingForm->itineraries))
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visaProcessingForm->itineraries as $item)
                    <tr>
                        <td>{{ $item['date'] ?? '' }}</td>
                        <td>{{ $item['from'] ?? '' }}</td>
                        <td>{{ $item['to'] ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- <h2>Visa Application Details</h2>

    <div class="section">
        <p><span class="label">Name:</span> {{ $visaProcessingForm->name }}</p>
        <p><span class="label">Passport Number:</span> {{ $visaProcessingForm->passport_number }}</p>
        <p><span class="label">Nationality:</span> {{ $visaProcessingForm->nationality }}</p>
        <p><span class="label">Travel From:</span> {{ $visaProcessingForm->travel_from }}</p>
        <p><span class="label">Travel Type:</span> {{ $visaProcessingForm->travel_type }}</p>
        <p><span class="label">Expected Travel Date:</span> {{ $visaProcessingForm->expected_travel_date ? $visaProcessingForm->expected_travel_date->format('Y-m-d') : 'N/A' }}</p>
    </div>

    <div class="section">
        <p><span class="label">Primary Contact:</span> {{ $visaProcessingForm->primary_contact }}</p>
        <p><span class="label">Emergency Contact:</span> {{ $visaProcessingForm->emergency_contact }}</p>
        <p><span class="label">Email:</span> {{ $visaProcessingForm->email }}</p>
    </div>

    <div class="section">
        <p><span class="label">Advance Purchase:</span> 
            {{ is_array($visaProcessingForm->advance_purchase) ? implode(', ', $visaProcessingForm->advance_purchase) : $visaProcessingForm->advance_purchase }}
        </p>
        <p><span class="label">Application Status:</span> {{ $visaProcessingForm->application_status }}</p>
        <p><span class="label">Payment Status:</span> {{ $visaProcessingForm->payment_status }}</p>
        <p><span class="label">Payment Method:</span> {{ $visaProcessingForm->payment_method }}</p>
        <p><span class="label">Payment Date:</span> {{ optional($visaProcessingForm->payment_date)->format('Y-m-d') ?? 'N/A' }}</p>
    </div>

    <h3>Uploaded Documents</h3>

    <div class="section">
        @if($visaProcessingForm->passport_copy)
            <p><span class="label">Passport Copy:</span></p>
            <img src="{{ public_path('storage/' . $visaProcessingForm->passport_copy) }}" class="doc-img">
        @endif

        @if($visaProcessingForm->ticket_copy)
            <p><span class="label">Ticket Copy:</span></p>
            <img src="{{ public_path('storage/' . $visaProcessingForm->ticket_copy) }}" class="doc-img">
        @endif

        @if($visaProcessingForm->hotel_booking)
            <p><span class="label">Hotel Booking:</span></p>
            <img src="{{ public_path('storage/' . $visaProcessingForm->hotel_booking) }}" class="doc-img">
        @endif

        @if($visaProcessingForm->other_doc)
            <p><span class="label">Other Documents:</span></p>
            <img src="{{ public_path('storage/' . $visaProcessingForm->other_doc) }}" class="doc-img">
        @endif
    </div> -->

</body>
</html>