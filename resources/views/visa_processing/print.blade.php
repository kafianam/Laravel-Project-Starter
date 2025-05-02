<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Voucher</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 40px;
    }

    .watermark {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0.08;
      z-index: 0;
      max-width: 600px;
      max-height: 600px;
    }

    .content {
      position: relative;
      z-index: 1;
    }

    .header {
      text-align: center;
    }

    .logo {
      width: 80%;
    }

    h3 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table, th, td {
      border: 1px solid #000;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    .disclaimer {
      margin-top: 30px;
      font-size: 14px;
    }

    .booking-seal {
      width: 130px;
      float: right;
      margin-top: 20px;
    }

    .footer {
      margin-top: 50px;
      font-size: 12px;
      text-align: right;
    }

    .bold {
      font-weight: bold;
    }
  </style>
</head>
<body>

  <img src="{{ asset('images/watermark.png') }}" alt="Watermark" class="watermark">

  <div class="content">
    <div class="header">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    </div>

    <h3>VOUCHER</h3>
    <p><span class="bold">Voucher:</span> BAST{{ $visaProcessingForm->id }}</p>
    <p><span class="bold">Name:</span> {{ $visaProcessingForm->name }}</p>
    <p><span class="bold">Passport:</span> {{ $visaProcessingForm->passport_number }}</p>
    <p><span class="bold">Nationality:</span> {{ $visaProcessingForm->nationality }}</p>
    <p><span class="bold">Travel From:</span> {{ $visaProcessingForm->travel_from }}</p>
    <p><span class="bold">Date:</span> {{ \Carbon\Carbon::parse($visaProcessingForm->expected_travel_date)->format('M d, Y') }}</p>

    <table>
      <thead>
        <tr>
          <th>Service</th>
          <th>Purpose</th>
          <th>Pax</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $visaProcessingForm->service->service_name }}</td>
          <td>{{ $visaProcessingForm->travel_type }}</td>
          <td>{{ $visaProcessingForm->guest_count ?? 1 }}</td>
          <td>{{ $visaProcessingForm->service->fee }} {{ $visaProcessingForm->service->currency ?? 'TK' }}</td>
        </tr>
        <tr>
          <td colspan="3" class="bold">
          @php
    $amount = $visaProcessingForm->service->fee;
    $currency = $visaProcessingForm->service->currency ?? 'TK';
    $amountInWords = class_exists('NumberFormatter') 
        ? strtoupper((new \NumberFormatter('en', \NumberFormatter::SPELLOUT))->format($amount)) 
        : $amount;
@endphp

<p><strong>Total:</strong> {{ $amountInWords }} {{ $currency }} Only</p>

          </td>
          <td>{{ $visaProcessingForm->service->fee }} {{ $visaProcessingForm->service->currency ?? 'TK' }}</td>
        </tr>
      </tbody>
    </table>

    <p class="bold">The service will be provided to you after we receive the visa.</p>

    <div class="disclaimer">
      <p><strong>DISCLAIMER:</strong></p>
      <ul>
        <li>This invitation (LOI) merely establishes that you are eligible to travel, but does not guarantee that you are entitled to enter Singapore. Upon arrival to Singapore, you will be inspected by a Singapore Immigration Entry/Exit Officer who may determine that you are inadmissible any reason under Singapore law.</li>
        <li>You have to confirm the service after receiving the visa. Otherwise the LOI sent by us will be legally invalid. Joy Travel & Tours Pte Ltd shall not be responsible for immigration or other legal issues in Singapore without our Travel Itinerary booking confirmation.</li>
        <li>A copy of Money Receipt should be printed on A4 size paper. The printed copy should be presented on arrival at Joy Travel & Tours Pte Ltd service point in Singapore.</li>
      </ul>
    </div>

    <img src="{{ asset('images/seal.png') }}" alt="Booking Seal" class="booking-seal">

  </div>

</body>
</html>
