@extends('layouts.app')

@section('content')
    <h1>Our Services</h1>

    <h3>Booking (Flight / Hotel / Transport)</h3>
    <form action="{{ url('/booking') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <select name="service" required>
            <option value="">Select a service</option>
            <option value="flight">Flight</option>
            <option value="hotel">Hotel</option>
            <option value="transport">Transport</option>
        </select><br>
        <textarea name="message" placeholder="Additional info (optional)"></textarea><br>
        <button type="submit">Submit</button>
    </form>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h3>Visa Processing</h3>
    <p>We help process tourist and business visas for multiple countries...</p>

    <h3>Travel Insurance</h3>
    <p>We provide info on travel insurance policies from top providers...</p>

    <h3>Corporate Tour</h3>
    <p>We organize group/corporate tours with end-to-end management...</p>
@endsection
