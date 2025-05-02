@extends('adminlte::page')
@section('css') <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> @endsection

@section('title', 'Applicant Details')

@section('content_header') <h1>Applicant Details</h1> @stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('visa_processing.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateItinerary();">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <label for="service_id">Service <span class="text-danger">*</span></label>
                        <select name="service_id" id="service_id" class="form-control" required style="font-size: 35px; height: 70px; width: 100%; margin-bottom: 5px;">
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_name }} - {{ $service->fee }} TK</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
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

                <!-- Guest Type Section -->
                <div class="row mt-3">
                    <div class="col-md-4">
                        <x-adminlte-select name="guest_type" label="Guest Type" id="guest_type" required>
                            <option value="">Select Type</option>
                            <option value="Single">Single</option>
                            <option value="Family">Family</option>
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-4" id="guest_count_wrapper" style="display: none;">
                        <x-adminlte-select name="guest_count" label="How Many Guests?" id="guest_count">
                            <option value="">Select Count</option>
                            @for ($i = 2; $i <= 9; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </x-adminlte-select>
                    </div>

                    <div class="col-md-4" id="relationship_wrapper" style="display: none;">
                        <x-adminlte-select name="relationship" label="Relationship" id="relationship">
                            <option value="">Select Relationship</option>
                            <option value="Self">Self</option>
                            <option value="Child">Child</option>
                            <option value="Parent">Parent</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                            <option value="Sibling">Sibling</option>
                            <option value="Friends">Friends</option>
                        </x-adminlte-select>
                    </div>
                </div>

                <!-- Advance Purchase -->
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

                <!-- Tour Itinerary Section -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Tour Itinerary</h5>
                    </div>
                    <div class="card-body">
                        <div id="itinerary-container">
                            <!-- Existing itineraries will be added here -->
                        </div>

                        <div class="border rounded p-3 mb-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Date *</label>
                                    <input type="date" class="form-control itinerary-date">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">From *</label>
                                    <input type="text" class="form-control itinerary-from">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">To *</label>
                                    <input type="text" class="form-control itinerary-to">
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button type="button" class="btn btn-primary" id="add-itinerary">Add Itinerary +</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <x-adminlte-button class="btn-primary" type="submit" label="Submit Form" />
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function validateItinerary() {
            const itineraryItems = document.querySelectorAll('.itinerary-item');
            if (itineraryItems.length === 0) {
                alert("Please add at least one Tour Itinerary before submitting.");
                return false;
            }
            return true;
        }
        document.addEventListener("DOMContentLoaded", function () {
            // Guest Type Logic
            const guestType = document.getElementById("guest_type");
            const guestCountWrapper = document.getElementById("guest_count_wrapper");
            const relationshipWrapper = document.getElementById("relationship_wrapper");

            if (guestType) {
                guestType.addEventListener("change", function () {
                    if (this.value === "Family") {
                        guestCountWrapper.style.display = "block";
                        relationshipWrapper.style.display = "block";
                    } else {
                        guestCountWrapper.style.display = "none";
                        relationshipWrapper.style.display = "none";
                    }
                });
            }

            // Itinerary Logic
            const itineraryContainer = document.getElementById('itinerary-container');
            const addItineraryBtn = document.getElementById('add-itinerary');
            let itineraryCount = 0;

            addItineraryBtn.addEventListener('click', function() {
                const date = document.querySelector('.itinerary-date').value;
                const from = document.querySelector('.itinerary-from').value;
                const to = document.querySelector('.itinerary-to').value;

                if (!date || !from || !to) {
                    alert('Please fill all itinerary fields');
                    return;
                }

                itineraryCount++;
                
                const itineraryHtml = `
                    <div class="itinerary-item mb-3 p-3 border rounded" data-index="${itineraryCount}">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="hidden" name="itineraries[${itineraryCount}][date]" value="${date}">
                                <strong>Date: </strong>${date}
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="itineraries[${itineraryCount}][from]" value="${from}">
                                <strong>From: </strong>${from}
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="itineraries[${itineraryCount}][to]" value="${to}">
                                <strong>To: </strong>${to}
                            </div>
                            <div class="col-md-1 text-end">
                                <button type="button" class="btn btn-sm btn-danger remove-itinerary">×</button>
                            </div>
                        </div>
                    </div>
                `;

                itineraryContainer.insertAdjacentHTML('beforeend', itineraryHtml);
                
                // Clear the input fields
                document.querySelector('.itinerary-date').value = '';
                document.querySelector('.itinerary-from').value = '';
                document.querySelector('.itinerary-to').value = '';
            });

            // Remove itinerary
            itineraryContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-itinerary')) {
                    e.target.closest('.itinerary-item').remove();
                }
            });
        });
    </script>
@stop