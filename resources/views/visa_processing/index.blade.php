@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('title', 'Visa Applications')

@section('content_header')
    <h1>Visa Application List</h1>
@stop

@section('content')
    <div class="card p-3">
        <form method="GET" action="{{ route('visa_processing.index') }}" class="mb-3 d-flex justify-content-between">
            <div>
                <a href="{{ route('visa_processing.create') }}" class="btn btn-primary">Visa Application Form</a>
                <a href="#" class="btn btn-outline-secondary">LOI Request</a>
            </div>
            <div>
                <button class="btn btn-success">Export To Excel</button>
            </div>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Guest Name</th>
                    <th>Date</th>
                    <th>Travel From</th>
                    <th>Nationality</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Service</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $form)
                    <tr>
                        <td>{{ $form->name }}<br>{{ $form->passport_number }}</td>
                        <td>
                            Travel: {{ \Carbon\Carbon::parse($form->expected_travel_date)->format('l, F j, Y') }}<br>
                            Issue: {{ \Carbon\Carbon::parse($form->passport_issue_date)->format('l, F j, Y') }}
                        </td>
                        <td>{{ $form->travel_from }}</td>
                        <td>{{ $form->nationality }}</td>
                        <td>
                            @if($form->passport_copy) ✅ Passport Copy<br> @endif
                            @if($form->ticket_copy) ✅ Ticket Copy<br> @endif
                            @if($form->hotel_booking) ✅ Hotel Copy<br> @endif
                            @if($form->other_doc) ✅ Others Doc<br> @endif
                        </td>
                        <td>{{ $form->application_status }}</td>
                        <td>{{ $form->payment_status }}</td>
                        <td>
                            {{ $form->service->service_name ?? 'N/A' }}<br>
                            Price: {{ $form->service->fee ?? '0' }} TK
                        </td>
                        <td>
                        <a href="{{ route('visa_processing.download_pdf', $form->id) }}" class="btn btn-sm btn-secondary" title="Download PDF" target="_blank">
                            <i class="fas fa-file-download"></i>
                            </a>

                            <a href="{{ route('visa_processing.show', $form->id) }}" class="btn btn-sm btn-primary"> <i class="fas fa-eye"></i></a>
                            <a href="{{ route('visa_processing.edit', $form->id) }}" class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></a>

                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('visa_processing.destroy', $form->id) }}" method="POST" class="delete-form d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"> <i class="fas fa-trash-alt"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script>
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Are you sure to delete applicant permanently?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    </div>
@stop
