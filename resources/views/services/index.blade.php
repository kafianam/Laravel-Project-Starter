@extends('adminlte::page')

@section('title', 'Services')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content_header')
    <h1>Service List</h1>
@stop

@section('content')
    <div class="card p-3">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('services.create') }}" class="btn btn-primary">Add Service</a>
            <a href="#" class="btn btn-success">Export to Excel</a>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Fee</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($service->count() > 0)
                    @foreach($service as $rs)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $rs->service_name }}</td>
                            <td class="align-middle">{{ $rs->fee }}</td>
                            <td class="align-middle">
                                <a href="{{ route('services.show', $rs->id) }}" class="btn btn-sm btn-secondary" title="Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('services.edit', $rs->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('services.destroy', $rs->id) }}" method="POST" class="delete-form d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="4">No Services Found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- SweetAlert delete confirmation --}}
        <script>
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to delete this service?",
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
